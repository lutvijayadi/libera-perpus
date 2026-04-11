<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/src/output.css">
    <title>Libera</title>

</head>

<body class="min-h-screen flex items-center pl-10 display-grid bg-no-repeat"
    style="background-image: url('../resources/img/cover%20book.png'); background-position: center; background-size: cover;">
<main>
    <form action="../aksi/aksi_login.php" method="post" class="ml-60 bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>
        <div class="mb-6">
            <label for="username" class="block text-gray-700 mb-2">Username</label>
            <input type="username" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="submit" class="w-full py-2 rounded-xl bg-blue-500 text-white font-semibold transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-900">Login</button>
        <p class="mt-4 text-center font-sans italic text-gray-600">belum punya akun? <a href="../auth/registrasiuser.php" class="text-blue-500 hover:underline">Daftar</a></p>
    </form>
    </main>
</body>
    
</html>