Add-Type -AssemblyName System.Drawing
$imgPath = Join-Path (Get-Location) "public\assets\images\picshar.jpg"
$icoPath = Join-Path (Get-Location) "logo.ico"

if (Test-Path $imgPath) {
    $img = [System.Drawing.Image]::FromFile($imgPath)
    $bitmap = New-Object System.Drawing.Bitmap(256, 256)
    $g = [System.Drawing.Graphics]::FromImage($bitmap)
    $g.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $g.DrawImage($img, 0, 0, 256, 256)
    $hIcon = $bitmap.GetHicon()
    $icon = [System.Drawing.Icon]::FromHandle($hIcon)
    
    if (Test-Path $icoPath) { Remove-Item $icoPath }
    $stream = [System.IO.File]::OpenWrite($icoPath)
    $icon.Save($stream)
    $stream.Close()
    
    $g.Dispose()
    $bitmap.Dispose()
    $img.Dispose()
    Write-Host "Icon created successfully at $icoPath"
} else {
    Write-Error "Image not found at $imgPath"
}
