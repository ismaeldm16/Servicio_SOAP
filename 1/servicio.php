<?php
ini_set("soap.wsdl_cache_enabled", 0); // Desactivar caché para desarrollo

class ServiciosSOAP
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=localhost;dbname=fp", "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new SoapFault("Server", "Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public function infoModulo(int $id)
    {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM modulos WHERE id = :id");
            $stmt->execute(["id" => $id]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return json_encode($resultado ?: ["error" => "Módulo no encontrado"]);
        } catch (PDOException $e) {
            return json_encode(["error" => "Error en la consulta de módulo: " . $e->getMessage()]);
        }
    }

    public function infoDepartamentos()
    {
        try {
            $stmt = $this->conexion->query("SELECT DISTINCT Departamento FROM modulos");
            $resultados = $stmt->fetchAll(PDO::FETCH_COLUMN);

            return json_encode($resultados ?: ["error" => "No hay departamentos disponibles"]);
        } catch (PDOException $e) {
            return json_encode(["error" => "Error en la consulta de departamentos: " . $e->getMessage()]);
        }
    }

    public function infoNomenclaturas()
    {
        try {
            $stmt = $this->conexion->query("SELECT DISTINCT nomenclatura FROM modulos");
            $resultados = $stmt->fetchAll(PDO::FETCH_COLUMN);

            return json_encode($resultados ?: ["error" => "No hay nomenclaturas disponibles"]);
        } catch (PDOException $e) {
            return json_encode(["error" => "Error en la consulta de nomenclaturas: " . $e->getMessage()]);
        }
    }
}

// Configuración del servidor SOAP
$options = [
    'uri' => 'http://localhost/SOAP/',
    'soap_version' => SOAP_1_2
];

$server = new SoapServer(null, $options);
$server->setClass('ServiciosSOAP');
$server->handle();
?>