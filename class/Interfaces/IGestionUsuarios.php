<?php
interface IGestionUsuarios {
    public function registrarUsuario(Usuario $usuario): bool;
    public function eliminarUsuario(Usuario $usuario): bool;
    public function buscarUsuario(string $nombre): ?Usuario;
}
?>
