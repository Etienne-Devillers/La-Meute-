<?php

define('REGEX_USERNAME', "^[A-Za-z-éèêëàâäôöûüç'_0-9 ]{3,20}+$");
define('REGEX_PASSWORD', ".*^(?=.{8,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$"); //Au moins une majuscule, une minuscule, un chiffre et un caractere special.