<?php
session_start();
include "../config/koneksi.php";

$id = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'");
$data = mysqli_fetch_assoc($query);
?>

<form action="update_profil.php" method="POST" enctype="multipart/form-data" class="space-y-4">

    <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

    <div>
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $data['username']; ?>" 
               class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Foto Profil</label>
        <input type="file" name="foto" class="w-full">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan Perubahan
    </button>

</form>