<?php

class Crypter {

    private $ciphering = "AES-128-CTR";
    private $encryptionKey = "Dogs want out!";
    private $options = 0;
    private $initializationVector = 9128432771011121;

    public function encryptID(string $id): string {
        return openssl_encrypt($id, $this->ciphering, $this->encryptionKey, $this->options, $this->initializationVector);
    }

    public function decryptID(string $encryptedID): string {
        return openssl_decrypt($encryptedID, $this->ciphering, $this->encryptionKey, $this->options, $this->initializationVector);
    }
}