<?php

namespace App\Hashers;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\AbstractHasher;

class DjangoHasher extends AbstractHasher implements Hasher
{
    public function make($value, array $options = [])
    {
        // For new passwords, we should use Laravel's default (Bcrypt)
        // But if we want to force Django style, we'd implement it here.
        // For migration, we usually re-hash to Bcrypt on first login.
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public function check($value, $hashedValue, array $options = [])
    {
        if (strpos($hashedValue, 'pbkdf2_sha256$') === 0) {
            return $this->checkDjangoPassword($value, $hashedValue);
        }

        return password_verify($value, $hashedValue);
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        // If it's a Django hash, it needs rehash to Bcrypt
        return strpos($hashedValue, 'pbkdf2_sha256$') === 0;
    }

    protected function checkDjangoPassword($password, $djangoHash)
    {
        $parts = explode('$', $djangoHash);
        if (count($parts) < 4) return false;

        list($algorithm, $iterations, $salt, $hash) = $parts;

        $computedHash = hash_pbkdf2(
            'sha256',
            $password,
            $salt,
            (int)$iterations,
            32,
            true
        );

        return base64_encode($computedHash) === $hash;
    }
}
