using System;
using System.Diagnostics;
using System.IO;
using System.Windows.Forms;
using System.Drawing;
using System.Threading;

class LauncherContext : ApplicationContext
{
    private NotifyIcon trayIcon;
    private Process phpProcess;

    public LauncherContext()
    {
        string currentDir = AppDomain.CurrentDomain.BaseDirectory;
        string phpExe = Path.Combine(currentDir, "bin", "php.exe");
        string phpIni = Path.Combine(currentDir, "bin", "php.ini");
        string publicDir = Path.Combine(currentDir, "public");

        if (!File.Exists(phpExe))
        {
            MessageBox.Show("لم يتم العثور على محرك PHP in " + phpExe);
            Environment.Exit(0);
        }

        // Try extracting icon from executable
        Icon appIcon = SystemIcons.Application;
        try {
            appIcon = Icon.ExtractAssociatedIcon(Application.ExecutablePath);
        } catch {}

        trayIcon = new NotifyIcon()
        {
            Icon = appIcon,
            ContextMenu = new ContextMenu(new MenuItem[] {
                new MenuItem("فتح النظام في المتصفح", OpenSystem),
                new MenuItem("إيقاف الخادم والخروج", Exit)
            }),
            Visible = true,
            Text = "نظام العدالة الذكي (يعمل في الخلفية)"
        };
        
        trayIcon.DoubleClick += OpenSystem;

        ProcessStartInfo startInfo = new ProcessStartInfo();
        startInfo.FileName = phpExe;
        startInfo.Arguments = "-c \"" + phpIni + "\" -S 127.0.0.1:8888 -t \"" + publicDir + "\"";
        startInfo.WorkingDirectory = currentDir;
        startInfo.WindowStyle = ProcessWindowStyle.Hidden;
        startInfo.CreateNoWindow = true;
        startInfo.UseShellExecute = false;

        try {
            phpProcess = Process.Start(startInfo);
            Process.Start("http://127.0.0.1:8888");
        } catch (Exception ex) {
            MessageBox.Show("Error: " + ex.Message);
            Environment.Exit(1);
        }
    }

    void OpenSystem(object sender, EventArgs e)
    {
        Process.Start("http://127.0.0.1:8888");
    }

    void Exit(object sender, EventArgs e)
    {
        if (phpProcess != null && !phpProcess.HasExited)
        {
            try { phpProcess.Kill(); } catch {}
        }
        
        try {
            foreach (var process in Process.GetProcessesByName("php")) {
                process.Kill();
            }
        } catch {}

        trayIcon.Visible = false;
        Application.Exit();
    }
}

class Program
{
    [STAThread]
    static void Main()
    {
        Application.EnableVisualStyles();
        Application.SetCompatibleTextRenderingDefault(false);
        bool createdNew = true;
        using (Mutex mutex = new Mutex(true, "JSJS_Justice_System_Mutex_Run", out createdNew))
        {
            if (createdNew)
            {
                Application.Run(new LauncherContext());
            }
            else
            {
                // If already running, just open browser
                Process.Start("http://127.0.0.1:8888");
            }
        }
    }
}
