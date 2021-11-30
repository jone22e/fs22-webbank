<?php


namespace App\Brasiltec\Types;


class NImage {


    private $image;
    private $imageBytea;

    protected $whiteList = [];
    protected $paletteLength = 10;
    protected $palette;
    protected $precision = 10;

    /**
     * NImage constructor.
     * @param $image
     */
    public function __construct($image = null) { $this->image = $image; }

    public function fromBytea($bitea)
    {
        $this->imageBytea = pg_unescape_bytea($bitea);
        $this->image = imagecreatefromstring(pg_unescape_bytea($bitea));
    }

    public function fromURL($url)
    {
        $binary_data = file_get_contents($url);
        $im = imagecreatefromstring($binary_data);
        $this->image = $im;
    }

    public function getResource()
    {
        imagecolortransparent($this->image, imagecolorallocatealpha($this->image, 0, 0, 0, 127));
        imagealphablending($this->image, false);
        imagesavealpha($this->image, true);

        /*$img = $this->image;

        $w = imagesx($img);
        $h = imagesy($img);
        $x = 0;
        $y = 0;

        if($w > $h) {
            $y = intval((300 - $h) / 2 + 1);
            $x = intval((300 - $w) / 2) + 1;
        } else {
            $x = intval((300 - $w) / 2) + 1;
            $y = intval((300 - $h) / 2) + 1;
        }

        $rec = imagecreatetruecolor(300, 300);
        imagesavealpha($rec, true);
        imagesavealpha($img, true);
        imagealphablending($rec, false);
        imagealphablending($img, false);



        imagecopyresized($rec, $img, 0, 0, 0-$x, 0-$y, 300, 300, 300, 300);

        imagesavealpha($rec, true);
        $trans_colour = imagecolorallocatealpha($rec, 0, 0, 0, 127);
        imagefill($rec, 0, 0, $trans_colour);

        $this->image = $rec;*/


        return $this->image;
    }

    public function resize($maxWidth = 300)
    {
        $imagem = $this->image;
        $imagem_original_x = imagesx($imagem);
        $imagem_original_y = imagesy($imagem);
        if ($imagem_original_x < $maxWidth) {
            $maxWidth = $imagem_original_x;
        }
        imagealphablending($imagem, true);
        imagesavealpha($imagem, true);
        $aspect = $imagem_original_y / $imagem_original_x;
        $hSize = intval($aspect * $maxWidth);
        $novafinal = imagecreatetruecolor($maxWidth, $hSize);
        imagealphablending($novafinal, true);
        imagesavealpha($novafinal, true);
        $transparent = imagecolorallocatealpha($novafinal, 0, 0, 0, 127);
        imagefill($novafinal, 0, 0, $transparent);
        imagecopyresampled($novafinal, $imagem, 0, 0, 0, 0, $maxWidth, $hSize, $imagem_original_x, $imagem_original_y);
        $this->image = $novafinal;
    }

    public function applyWaterMark($text)
    {

        $width = imagesx($this->image);
        $height = imagesy($this->image);

        $color = imagecolorallocatealpha($this->image, 255, 255, 255, 80);
        $wm = $text;
        for ($i = 0; $i <= $height; $i = $i + 50) {
            for ($a = 0; $a < $width; $a = $a + 90) {
                imagettftext($this->image,
                    10,
                    45,
                    $a,
                    $i,
                    $color,
                    $_SERVER['DOCUMENT_ROOT'] . '/font/ProximaNova-Regular.woff',
                    $wm);
            }
            // imagettftext($this->image, 10, 45, 90, $i, $color, $_SERVER['DOCUMENT_ROOT'] . '/font/ProximaNova-Regular.woff', $wm);
            // imagettftext($this->image, 10, 45, 180, $i, $color, $_SERVER['DOCUMENT_ROOT'] . '/font/ProximaNova-Regular.woff', $wm);
            // imagettftext($this->image, 10, 45, 270, $i, $color, $_SERVER['DOCUMENT_ROOT'] . '/font/ProximaNova-Regular.woff', $wm);
            // imagettftext($this->image, 10, 45, 360, $i, $color, $_SERVER['DOCUMENT_ROOT'] . '/font/ProximaNova-Regular.woff', $wm);
        }
        imagealphablending($this->image, false);
        imagesavealpha($this->image, true);
    }

    public function toImage()
    {
        return imagepng($this->image);
    }

    public function toImageBytes()
    {
        return $this->imageBytea;
    }

    public function toBase64()
    {
        if ($this->image != null) {
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);

            ob_start();
            imagepng($this->image);
            $data = ob_get_clean();
            return "data:image/png;base64," . base64_encode($data);
        }
    }

    public function toBase64fromBytes()
    {
        ob_start();
        imagepng($this->imageBytea);
        $data = ob_get_clean();
        return "data:image/png;base64," . base64_encode($data);
    }

    public function createImage($text, $fontSize = 10, $imgWidth = 50, $imgHeight = 50)
    {
        $font = $_SERVER['DOCUMENT_ROOT'] . '/font/ProximaNova-Regular.woff';

        $this->image = imagecreatetruecolor($imgWidth, $imgHeight);
        //create some colors
        $white = imagecolorallocate($this->image, 255, 255, 255);
        $grey = imagecolorallocate($this->image, 128, 128, 128);
        $black = imagecolorallocate($this->image, 0, 0, 0);
        imagefilledrectangle($this->image, 0, 0, $imgWidth - 1, $imgHeight - 1, $white);

        //break lines
        $splitText = explode("\\n", $text);
        $lines = count($splitText);

        foreach ($splitText as $txt) {
            $textBox = imagettfbbox($fontSize, $angle, $font, $txt);
            $textWidth = abs(max($textBox[2], $textBox[4]));
            $textHeight = abs(max($textBox[5], $textBox[7]));
            $x = (imagesx($this->image) - $textWidth) / 2;
            $y = ((imagesy($this->image) + $textHeight) / 2) - ($lines - 2) * $textHeight - $fontSize;
            $lines = $lines - 1;

            //add some shadow to the text
            imagettftext($this->image, $fontSize, $angle, $x, $y, $grey, $font, $txt);

            //add the text
            imagettftext($this->image, $fontSize, $angle, $x, $y, $black, $font, $txt);
        }
    }

    public function readPixels()
    {
        $width = imagesx($this->image);
        $height = imagesy($this->image);

        for ($x = 0; $x < $width; $x += $this->precision) {
            for ($y = 0; $y < $height; $y += $this->precision) {
                $color = $this->getPixelColor($x, $y);
                // transparent pixels don't really have a color
                if ($color->isTransparent()) {
                    continue 1;
                }
                // increment closes whiteList color (key)
                $this->whiteList[$this->getClosestColor($color)]++;
                //error_log(json_encode($this->whiteList));
            }
        }

        // error_log(json_encode($this->whiteList));
        arsort($this->whiteList);
        // error_log(json_encode($this->whiteList));

        $this->palette = array_map(function ($color) { return (new NColor($color))->toHexString(); },
            array_keys($this->whiteList));
    }

    /**
     * @return array
     */
    public function getImageSize()
    {
        $width = imagesx($this->image);
        $height = imagesy($this->image);
        return [$width, $height];
    }

    public function detectImage($points)
    {
        $lineColor = imagecolorallocate($this->image, 0,255, 0);
        imagesetthickness ( $this->image , 5);
         $point = json_decode($points);
        imageline($this->image, $point->x1, $point->y1, $point->x2, $point->y2, $lineColor);
        imageline($this->image, $point->x3, $point->y3, $point->x4, $point->y4, $lineColor);
        imageline($this->image, $point->x1, $point->y1, $point->x3, $point->y3, $lineColor);
        imageline($this->image, $point->x2, $point->y2, $point->x4, $point->y4, $lineColor);
    }

    private function hypo() {
        $sum = 0;
        foreach (func_get_args() as $dimension) {
            if (!is_numeric($dimension)) return -1;
            $sum += pow($dimension, 2);
        }
        return sqrt($sum);
    }

    public function detectAspects($points) {
        $point = json_decode($points);
        $a = ceil($this->hypo($point->x3, $point->y3 - $point->y1));
        $b = ceil($this->hypo($point->x4 - $point->x3, $point->y3 - $point->y4));
        $c = ceil($this->hypo($point->x4 - $point->x2, $point->y4));
        $d = ceil($this->hypo($point->x2, $point->y1));
        $dif_ac = ceil($c / $a);
        $dif_ca = ceil($a / $c);
        $dif_bd = ceil($d / $b);
        $dif_db = ceil($b / $d);
        return json_encode([
           "a"=> $dif_ac,
           "b"=> $dif_ca,
           "c"=> $dif_bd,
           "d"=> $dif_db,
        ]);
    }

    public function getObjectPixelsColors() {
        $width = imagesx($this->image);
        $height = imagesy($this->image);
        for ($x = 0; $x < $width; $x += 1) {
            for ($y = 0; $y < $height; $y += 1) {
                $rgb = imagecolorat($this->image, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $a = ($rgb >> 24) & 0xff;
                if ($a<120) {

                }
            }
        }
    }

    public function getObjectPixels()
    {
        $width = imagesx($this->image);
        $height = imagesy($this->image);

        $cores = 1;
        $x1 = null;  $x2 = null;
        $x3[] = 0; $x4[] = 0;
        $y1[] = 0; $y2[] = 0;
        $y3[] = 0; $y4[] = 0;
        $circles = 0;
        $nextTest = 0;
        for ($x = 0; $x < $width; $x += 1) {
            for ($y = 0; $y < $height; $y += 1) {
                $rgb = imagecolorat($this->image, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $a = ($rgb >> 24) & 0xff;


                if ($r < 200 && $a <= 120) {

                    $cor = 0;
                    if ($x1 == null) {
                        $x1[$cor] = $x; $y1[$cor] = $y;
                        $x2[$cor] = $x; $y2[$cor] = $y;
                        $x3[$cor] = $x; $y3[$cor] = $y;
                        $x4[$cor] = $x; $y4[$cor] = $y;
                    }
                    if ($y2[$cor] > $y) {
                        $y2[$cor] = $y;
                        $x2[$cor] = $x;
                    }
                    if ($y3[$cor] < $y) {
                        $y3[$cor] = $y;
                        $x3[$cor] = $x;
                    }
                    if ($x4[$cor] < $x) {
                        $y4[$cor] = $y;
                        $x4[$cor] = $x;
                    }




                   /* $votes = 0;
                    $maxvotes = 0;
                    for ($i = 0; $i < 20; $i++) {
                        $actualX = intval($x + $i * cos(45));
                        $actualY = intval($y + $i * sin(45));
                        $prev = imagecolorat($this->image, $actualX, $actualY);
                        if ($rgb == $prev) {
                            $votes++;
                        }
                        $maxvotes++;
                    }
                    if (($votes/$maxvotes)*100 > 99) {
                        $circles++;
                    }*/



                }


            }
        }

        for ($core = 0; $core < $cores; $core++) {
            $padrao = [
                'x1' => $x1[$core],
                'y1' => $y1[$core],
                'x2' => $x2[$core],
                'y2' => $y2[$core],
                'x3' => $x3[$core],
                'y3' => $y3[$core],
                'x4' => $x4[$core],
                'y4' => $y4[$core],
            ];
        }


        return json_encode($padrao);
    }

    public function getPixelColor($x, $y)
    {
        $color = imagecolorat($this->image, $x, $y);
        //error_log($color);
        return new NColor($color);
    }

    /**
     * @param NColor $color
     * @return int|string
     */
    private function getClosestColor(NColor $color)
    {
        $bestDiff = PHP_INT_MAX;

        // default to black so hhvm won't cry
        $bestColor = $color->toInt();


        foreach ($this->whiteList as $wlColor => $hits) {
            // error_log($wlColor.' => '.$hits);
            // calculate difference (don't sqrt)
            $diff = $color->getDiff($wlColor);

            // see if we got a new best
            if ($diff < 100) {
                $bestDiff = $diff;
                $bestColor = $wlColor;
            }
        }

        //error_log(hexdec($bestColor));
        return $bestColor;
    }


    /**
     * @param null $paletteLength
     * @return array
     */
    public function getColors($paletteLength = null)
    {
        // allow custom length calls
        if (!is_numeric($paletteLength)) {
            $paletteLength = $this->paletteLength;
        }

        // take the best hits
        return array_slice($this->palette, 0, $paletteLength, true);
    }

    public function getColorsOnly($paletteLength = null)
    {
        // allow custom length calls
        if (!is_numeric($paletteLength)) {
            $paletteLength = $this->paletteLength;
        }

        // take the best hits
        return array_slice($this->palette, 0, $paletteLength, false);
    }


    /**
     * @param NImage $fotoComparativa
     * @return false|float
     */
    public function getMatchPercentage(NImage $fotoComparativa)
    {
        $origem = $fotoComparativa->getColorsOnly(30);
        $destino = $this->getColorsOnly(30);
        foreach ($origem as $orig) {
            $color = new NColor(0);
            $color->fromHexString($orig);
            foreach ($destino as $dest) {
                $colorDest = new NColor(0);
                $colorDest->fromHexString($dest);
                $dif = $color->getDiff($colorDest);
                if ($dif == 0) {
                    $dif = $colorDest->getDiff($color);
                }
                if ($dif < 100) {
                    $matches++;
                    break;
                }
            }
        }
        return ceil(($matches * 100 / 30));
    }

    public function getMatchPercentageWithJson($cores)
    {
        $origem = $this->getColorsOnly(30);
        $destino = json_decode($cores);
        foreach ($origem as $orig) {
            $color = new NColor(0);
            $color->fromHexString($orig);
            foreach ($destino as $dest) {
                $colorDest = new NColor(0);
                $colorDest->fromHexString($dest);
                $dif = $color->getDiff($colorDest);
                if ($dif == 0) {
                    $dif = $colorDest->getDiff($color);
                }
                if ($dif < 100) {
                    $matches++;
                    break;
                }
            }
        }
        return ceil(($matches * 100 / 30));
    }

}