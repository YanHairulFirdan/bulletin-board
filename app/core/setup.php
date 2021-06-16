<?php

if (!file_exists(ROOT . '\logs\\error.log')) {
    mkdir(ROOT . '\logs');
    touch(ROOT . '\logs\\error.log');
}
