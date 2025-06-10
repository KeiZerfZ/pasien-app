<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Data Pasien</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Warna latar belakang abu-abu muda */
        }
        .container {
            max-width: 1200px; /* Batasi lebar kontainer */
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #e0e0e0;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }
        .form-input, .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem; /* rounded-lg */
            background-color: #ffffff;
            font-size: 1rem;
            line-height: 1.5;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-input:focus, .form-select:focus {
            border-color: #6366f1; /* indigo-500 */
            outline: 0;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-align: center;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }
        .btn-primary {
            background-color: #6366f1; /* indigo-500 */
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #4f46e5; /* indigo-600 */
        }
        .btn-danger {
            background-color: #ef4444; /* red-500 */
            color: #ffffff;
        }
        .btn-danger:hover {
            background-color: #dc2626; /* red-600 */
        }
        .btn-secondary {
            background-color: #6b7280; /* gray-500 */
            color: #ffffff;
        }
        .btn-secondary:hover {
            background-color: #4b5563; /* gray-600 */
        }
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
            color: #ffffff;
        }
        .alert-success {
            background-color: #10b981; /* green-500 */
        }
        .alert-error {
            background-color: #ef4444; /* red-500 */
        }
    </style>
</head>
<body class="antialiased">
    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('pasien.index') }}" class="text-white text-2xl font-bold rounded-lg px-3 py-2 hover:bg-indigo-700 transition duration-200">Aplikasi Data Pasien</a>
            <div>
                <a href="{{ route('pasien.index') }}" class="text-white hover:text-indigo-200 rounded-lg px-3 py-2 transition duration-200">Daftar Pasien</a>
                <a href="{{ route('pasien.create') }}" class="text-white hover:text-indigo-200 rounded-lg px-3 py-2 transition duration-200 ml-4">Tambah Pasien Baru</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-6 mt-8">
        <!-- Notifikasi sukses/error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- Konten Halaman akan di-inject di sini -->
        @yield('content')
    </div>
</body>
</html>

