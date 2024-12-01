<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function createFilm($nome, $genero, $avaliacao)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Filme (nome, genero, avaliacao) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $genero, $avaliacao);
    return $stmt->execute();
}

function readFilms()
{
    global $conn;
    $sql = "SELECT * FROM Filme";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateFilm($id, $nome, $genero, $avaliacao)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE Filme SET nome = ?, genero = ?, avaliacao = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nome, $genero, $avaliacao, $id);
    return $stmt->execute();
}

function deleteFilm($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM Filme WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    if ($action === 'create') {
        createFilm($_POST['nome'], $_POST['genero'], $_POST['avaliacao']);
    } elseif ($action === 'update') {
        updateFilm($_POST['id'], $_POST['nome'], $_POST['genero'], $_POST['avaliacao']);
    } elseif ($action === 'delete') {
        deleteFilm($_POST['id']);
    }
    header('Location: index.php');
    exit();
}



