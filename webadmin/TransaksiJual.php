<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .pasang-konten {
            border: 5px;
            padding: 20px;
            height: 400px;
        }
        .button-container {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }
        .tombol-fungsi1 {
            width: 290px;
            height: 50px;
            border: 5px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .tombol-fungsi2 {
            width: 150px;
            height: 50px;
            border: 5px;
            margin-left: -60px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kontentabel {
            border: 5px;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
        .table-container {
            width: 200px;
            margin: 0;
        }
        .content-container {
            display: flex;
            justify-content: space-between;
            background-color: blue;
            padding: 10px;
        }
        .left-container {
            width: 48%;
            background-color: lightblue;
            margin-right: 10px;
            padding: 10px;
        }
        .right-container {
            width: 48%;
            background-color: lightblue;
            margin-left: 10px;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .actions a {
            margin-right: 5px;
            text-decoration: none;
        }
    </style>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_pweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">UTAMA</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Pelanggan.php"><span>Pelanggan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Pemasok.php"><span>Pemasok</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Item.php"><span>Item</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Rekening.php"><span>Rekening</span></a>
            </li>
            <div class="sidebar-heading">TRANSAKS JUALI</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="TransaksiJual.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Transaksi Jual</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="TransaksiBeli.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Transaksi Beli</span></a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>TRANSAKSI</h2>
                    <form action="generatepdf-jual.php" method="POST">
                        <input type="hidden" name="tableData" id="tableDataInput">
                        <button class="btn btn-success" style="background-color: #4e73df; margin-left: 480px;" type="submit">Generate PDF</button>
                    </form>
                </nav>
                <div class="pasang-konten">
                    <h4>CHECKOUT</h4>
                    <div class="container">
                        <div class="content-container">
                            <div class="left-container" id="TABELITEM">
                                <table border="0">
                                    <tr>
                                        <td>Note: <!--BAGIAN SINI AUTO GENERATE AA-000 INCREMENT HINGGA 999 MENJADI AB-->
                                            <span id="nomorNota"></span>
                                        </td>
                                        <td>Rekening: <!--BAGIAN INI MENJADI DROP DOWN OTOMATIS DARI TABEL REKENING YANG DIJADIKAN DROPDOWNNYA ITU NAMA REKENING-->
                                            <select id="rekening" name="rekening" class="form-control"></select>
                                        </td>
                                    </tr>
                                </table>
                                <table id="itemTable">
                                    <thead>
                                        <tr>
                                            <th>Kode Item</th>
                                            <th>Nama</th>
                                            <th>Qty</th>
                                            <th>Harga Jual</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td id="totalValue">0</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button class="btn btn-primary" id="updateSaldo">
                                    <!--BAGIAN INI TOMBOL CHECKOUT UNTUK SEBUAH FUNGSI PHP-->
                                    Checkout
                                </button>
                            </div>
                            <div class="right-container">
                                <div class="container mt-5">
                                    <div class="form-container">
                                        <h2>Tambahkan Item</h2>
                                        <form id="searchForm">
                                            <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
                                            <button class="btn btn-primary mt-2" type="submit">Search</button>
                                        </form>
                                        <div id="searchResult" style="color: red;"></div>
                                        <form id="itemForm" class="mt-3" onsubmit="addItem(event)">
                                            <div class="form-group">
                                                <label for="kodeitem">Kode Item</label>
                                                <input type="text" id="kodeitem" name="kodeitem" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" id="nama" name="nama" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">Qty</label>
                                                <input type="number" id="qty" name="qty" class="form-control" min="1" value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="hargajual">Harga Jual</label>
                                                <input type="text" id="hargajual" name="hargajual" class="form-control" readonly>
                                            </div>
                                            <div class="button-container">
                                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="vendor/jquery/jquery.min.js"></script>
                        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                        <script src="js/sb-admin-2.min.js"></script>
                        <script>
                            let tableData = [];
                            let itemCounter = 1;

                            $(document).ready(function() {
                                generateNotaNumber();
                                populateRekeningDropdown();

                                $('#searchForm').on('submit', function(event) {
                                    event.preventDefault();
                                    searchItems();
                                });

                                $('#updateSaldo').on('click', function() {
                                    checkout();
                                });
                            });

                            function generateNotaNumber() {
                                const prefix = 'AA-';
                                const nextNumber = itemCounter.toString().padStart(3, '0');
                                const notaNumber = prefix + nextNumber;
                                $('#nomorNota').text(notaNumber);
                            }

                            function populateRekeningDropdown() {
                                $.ajax({
                                    url: 'get_rekening.php',
                                    method: 'GET',
                                    success: function(data) {
                                        $('#rekening').html(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error fetching rekening:', status, error);
                                    }
                                });
                            }

                            function searchItems() {
                                const searchQuery = $('#search').val();
                                $.ajax({
                                    url: 'search_items.php',
                                    type: 'GET',
                                    data: { search: searchQuery },
                                    success: function(response) {
                                        const item = JSON.parse(response);
                                        if (item) {
                                            $('#kodeitem').val(item.kodeitem);
                                            $('#nama').val(item.nama);
                                            $('#hargajual').val(item.hargajual);
                                            $('#searchResult').text('');
                                        } else {
                                            $('#searchResult').text('Item not found');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error:', status, error);
                                    }
                                });
                            }

                            function addItem(event) {
                                event.preventDefault();
                                const kodeitem = $('#kodeitem').val();
                                const nama = $('#nama').val();
                                const qty = parseInt($('#qty').val());
                                const hargajual = parseFloat($('#hargajual').val());

                                if (kodeitem && nama && qty && hargajual) {
                                    const item = { kodeitem, nama, qty, hargajual };
                                    tableData.push(item);
                                    renderTable();
                                    resetForm();
                                }
                            }

                            function renderTable() {
                                const tbody = $('#itemTable tbody');
                                tbody.empty();
                                let total = 0;
                                tableData.forEach((item, index) => {
                                    const row = `<tr>
                                        <td>${item.kodeitem}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.qty}</td>
                                        <td>${item.hargajual}</td>
                                        <td class="actions">
                                            <a href="#" onclick="editItem(${index})">Edit</a>
                                            <a href="#" onclick="removeItem(${index})">Remove</a>
                                        </td>
                                    </tr>`;
                                    tbody.append(row);
                                    total += item.qty * item.hargajual;
                                });
                                $('#totalValue').text(total.toFixed(2));
                                $('#tableDataInput').val(JSON.stringify(tableData));
                            }

                            function editItem(index) {
                                const item = tableData[index];
                                $('#kodeitem').val(item.kodeitem);
                                $('#nama').val(item.nama);
                                $('#qty').val(item.qty);
                                $('#hargajual').val(item.hargajual);
                                tableData.splice(index, 1);
                                renderTable();
                            }

                            function removeItem(index) {
                                tableData.splice(index, 1);
                                renderTable();
                            }

                            function resetForm() {
                                $('#itemForm')[0].reset();
                            }

                            function checkout() {
                                const rekening = $('#rekening').val();
                                $.ajax({
                                    url: 'checkout.php',
                                    type: 'POST',
                                    data: {
                                        tableData: JSON.stringify(tableData),
                                        rekening: rekening
                                    },
                                    success: function(response) {
                                        alert(response);
                                        location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('AJAX Error:', status, error);
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
