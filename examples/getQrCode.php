<?php
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

/**
 * 生产二维码示例
 */
$qrcode = new BaconQrCodeGenerator;
$porder = 'yh4ea65gh41ae65t4pxm-123123-999-1534925308319-BAIC';
echo $qrcode->size(500)->generate($porder);