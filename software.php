<?php

$software = [
  ["codigo" => 1, "nombre" => "Word", "desarrollador" => "Microsoft", "plataforma" => "Windows", "version" => "2021", "licencia" => "free"],
  ["codigo" => 2, "nombre" => "Excel", "desarrollador" => "Microsoft", "plataforma" => "Windows", "version" => "2021", "licencia" => "free"],
  ["codigo" => 3, "nombre" => "Power Point", "desarrollador" => "Microsoft", "plataforma" => "Windows", "version" => "2021", "licencia" => "free"],
  ["codigo" => 4, "nombre" => "Chrome", "desarrollador" => "Google", "plataforma" => "Movil", "version" => "112.0.5615.138", "licencia" => "free"],
  ["codigo" => 5, "nombre" => "Egde", "desarrollador" => "Microsoft", "plataforma" => "Windows", "version" => " 92.0.902.67", "licencia" => "free"],
  ["codigo" => 6, "nombre" => "Clash Royale", "desarrollador" => "Supercell", "plataforma" => "Movil", "version" => "3.3186.7", "licencia" => "free"],
  ["codigo" => 7, "nombre" => "HBO", "desarrollador" => "Warner Bros. Discovery", "plataforma" => "Movil", "version" => "53.20.02", "licencia" => "free"],
];

echo json_encode($software);