<?php


namespace App\Brasiltec\Types;


class NMask {
    public function mask($id) {
        return 259763480 + $id;
    }

    public function unMask($id) {
        return $id - 259763480;
    }
}