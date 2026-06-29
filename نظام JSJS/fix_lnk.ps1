Rename-Item -Path "نظام_العدالة.exe" -NewName "نظام_العدالة_المحمول.exe" -Force
$sh = New-Object -COM WScript.Shell
$lnk = $sh.CreateShortcut("C:\Users\a\Desktop\نظام_العدالة.lnk")
$lnk.TargetPath = "C:\Users\a\Desktop\نظام JSJS\نظام_العدالة_المحمول.exe"
$lnk.IconLocation = "C:\Users\a\Desktop\نظام JSJS\نظام_العدالة_المحمول.exe, 0"
$lnk.Save()
Write-Host "Shortcut updated successfully"
