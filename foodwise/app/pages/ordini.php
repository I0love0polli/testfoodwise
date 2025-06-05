<?php
// Dati ordini (esempio, da sostituire con dati reali dal database)
$ordini = [
    [
        'id' => '001',
        'data' => '15 settembre alle 20:30',
        'status' => 'consegnato',
        'items' => [
            ['nome' => 'Spaghetti alla Carbonara', 'quantita' => 2, 'prezzo' => 29.00],
            ['nome' => 'Patate al Rosmarino', 'quantita' => 1, 'prezzo' => 6.00]
        ],
        'tavolo' => 'Tavolo 5',
        'totale' => 35.00
    ],
    [
        'id' => '002',
        'data' => '15 settembre alle 21:15',
        'status' => 'preparazione',
        'items' => [
            ['nome' => 'Bistecca alla Fiorentina', 'quantita' => 1, 'prezzo' => 28.00],
            ['nome' => 'Insalata Mista', 'quantita' => 1, 'prezzo' => 5.50],
            ['nome' => 'Tiramisù', 'quantita' => 2, 'prezzo' => 10.00],
            ['nome' => 'Pizza Margherita', 'quantita' => 1, 'prezzo' => 12.00],
            ['nome' => 'Gelato', 'quantita' => 3, 'prezzo' => 9.00]
        ],
        'tavolo' => 'Tavolo 5',
        'totale' => 64.50
    ],
    [
        'id' => '003',
        'data' => '15 settembre alle 21:45',
        'status' => 'in attesa',
        'items' => [
            ['nome' => 'Bruschetta al Pomodoro', 'quantita' => 1, 'prezzo' => 8.50]
        ],
        'tavolo' => 'Tavolo 5',
        'totale' => 8.50
    ],
    [
        'id' => '003',
        'data' => '15 settembre alle 21:45',
        'status' => 'in attesa',
        'items' => [
            ['nome' => 'Bruschetta al Pomodoro', 'quantita' => 1, 'prezzo' => 8.50]
        ],
        'tavolo' => 'Tavolo 5',
        'totale' => 8.50
    ]
];
$tableId = 5;
$coperti = 4; // Numero di coperti (esempio, sostituire con dato reale dal database)
$costoCopertoUnitario = 2.00; // Costo unitario del coperto
$costoTotaleCoperti = $coperti * $costoCopertoUnitario; // Calcolo costo totale coperti
?>

<div class="container ordini-container">
    <div class="carrello-header">
        <h1 class="carrello-header-title">I tuoi ordini</h1>
        <div class="carrello-header-info">
            <span class="carrello-table">Tavolo <?php echo htmlspecialchars($tableId); ?></span>
        </div>
    </div>

    <div class="ordini-content">
        <?php foreach ($ordini as $ordine): ?>
            <div class="order-card" data-order="#<?php echo htmlspecialchars($ordine['id']); ?>" data-table="<?php echo htmlspecialchars($ordine['tavolo']); ?>" data-status="<?php echo strtolower(htmlspecialchars($ordine['status'])); ?>">
                <div class="card restaurant-info-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">
                                Ordine #<?php echo htmlspecialchars($ordine['id']); ?>
                            </h5>
                            <span class="badge <?php 
                                echo $ordine['status'] === 'consegnato' ? 'status-served' : 
                                     ($ordine['status'] === 'preparazione' ? 'status-preparing' : 'status-pending'); ?>">
                                <i data-lucide="<?php 
                                    echo $ordine['status'] === 'consegnato' ? 'check' : 
                                         ($ordine['status'] === 'preparazione' ? 'chef-hat' : 'clock'); ?>" class="status-icon"></i>
                                <?php 
                                    echo $ordine['status'] === 'consegnato' ? 'Consegnato' : 
                                         ($ordine['status'] === 'preparazione' ? 'In preparazione' : 'In attesa'); ?>
                            </span>
                        </div>
                        <div class="mb-2 time-text">
                            <i data-lucide="clock" class="clock-icon"></i>
                            <span><?php echo htmlspecialchars($ordine['data']); ?></span>
                        </div>
                        <div class="separator-line"></div>
                        <ul class="list-unstyled order-list">
                            <?php if (empty($ordine['items'])): ?>
                                <li class="d-flex justify-content-between align-items-center mb-1">
                                    <span>Nessun articolo</span>
                                </li>
                            <?php else: ?>
                                <?php foreach ($ordine['items'] as $item): ?>
                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                        <span>
                                            <i data-lucide="<?php echo $ordine['status'] === 'consegnato' ? 'circle-check' : 'circle-alert'; ?>" class="order-icon <?php echo $ordine['status'] === 'consegnato' ? 'green' : 'orange'; ?>"></i>
                                            <?php echo htmlspecialchars($item['nome']); ?>
                                            <span class="quantity">x<?php echo htmlspecialchars($item['quantita']); ?></span>
                                        </span>
                                        <span class="price-container">€<?php echo number_format($item['prezzo'], 2); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="separator-line"></div>
                        <div class="d-flex justify-content-between align-items-center mt-2 footer-container">
                            <div class="table-info">
                                <span class="table-text">
                                    <i data-lucide="hash" class="hash-icon"></i>
                                    <?php echo count($ordine['items']); ?> articoli
                                </span>
                            </div>
                            <div class="price-container">
                                <span class="price">Totale €<?php echo number_format($ordine['totale'], 2); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <!-- Card per il coperto -->
        <div class="order-card coperto-card">
            <div class="card restaurant-info-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">Coperto</h5>
                        <span class="badge status-coperto">
                            <i data-lucide="handshake" class="status-icon"></i>
                            Coperti
                        </span>
                    </div>
                    <div class="separator-line"></div>
                    <ul class="list-unstyled order-list">
                        <li class="d-flex justify-content-between align-items-center mb-1">
                            <span>
                                <i data-lucide="users" class="order-icon green"></i>
                                Coperto <span class="quantity">x<?php echo htmlspecialchars($coperti); ?></span>
                            </span>
                            <span class="price-container">€<?php echo number_format($costoCopertoUnitario, 2); ?></span>
                        </li>
                    </ul>
                    <div class="separator-line"></div>
                    <div class="d-flex justify-content-between align-items-center mt-2 footer-container">
                        <div class="table-info">
                            <span class="table-text">
                                <i data-lucide="users" class="hash-icon"></i>
                                Totale coperti
                            </span>
                        </div>
                        <div class="price-container">
                            <span class="price">€<?php echo number_format($costoTotaleCoperti, 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container.ordini-container {
        background-color: #121212;
        color: #ffffff;
        padding: 0;
        margin: 0;
        border: none;
        width: 100%;
        max-width: none;
        box-sizing: border-box;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        overflow: hidden;
    }

    .carrello-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #121212;
        z-index: 10;
        padding: 10px 0;
        margin: 0;
    }

    .carrello-header-title {
        text-align: center;
        font-size: 20px;
        padding: 0;
        margin: 0;
        text-transform: uppercase;
        color: #ffffff;
        padding-bottom: 15px;
    }

    .ordini-content {
        margin-top: 70px;
        padding: 0 15px 70px;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        overflow-x: hidden;
        height: 600px;
        width: calc(100% - 30px);
        margin-left: 15px;
        scrollbar-width: thin;
        scrollbar-color: #1e1e1e transparent;
        padding-top: 50px !important;
    }

    .ordini-content::-webkit-scrollbar {
        width: 8px;
    }

    .ordini-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .ordini-content::-webkit-scrollbar-thumb {
        background: #1e1e1e;
        border-radius: 10px;
    }

    .ordini-content::-webkit-scrollbar-thumb:hover {
        background: #2a2a2a;
    }

    .order-card {
        margin-bottom: 6px;
        width: 100%;
        position: relative;
        padding-top: 10px;
    }

    .restaurant-info-card {
        background-color: #1f1f1f;
        border: 1px solid #2a2a2a;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        width: 100%;
    }

    .card-body {
        padding: 12px;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
    }

    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 50px;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        margin-left: 10px;
    }

    .status-icon {
        width: 14px;
        height: 14px;
        margin-right: 0.25rem;
    }

    .status-served {
        background-color: rgba(0, 255, 127, 0.2);
        border: 1px solid #00FF7F;
        color: #00FF7F;
    }

    .status-served .status-icon {
        color: #00FF7F;
    }

    .status-preparing {
        background-color: rgba(234, 179, 8, 0.2);
        border: 1px solid #EAB308;
        color: #EAB308;
    }

    .status-preparing .status-icon {
        color: #EAB308;
    }

    .status-pending {
        background-color: rgba(6, 182, 212, 0.2);
        border: 1px solid #06B6D4;
        color: #06B6D4;
    }

    .status-pending .status-icon {
        color: #06B6D4;
    }

    /* Stili per la card del coperto */
    .coperto-card {
        margin-bottom: 6px;
        width: 100%;
        position: relative;
        padding-top: 10px;
    }

    .status-coperto {
        background-color: rgba(236, 72, 153, 0.2);
        border: 1px solid #EC4899;
        color: #EC4899;
    }

    .status-coperto .status-icon {
        color: #EC4899;
    }

    .time-text {
        color: #e0e0e0;
        font-size: 0.75rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .clock-icon {
        width: 16px;
        height: 16px;
        margin-right: 0.25rem;
        color: #ffffff;
    }

    .table-text {
        color: #e0e0e0;
        display: flex;
        align-items: center;
    }

    .hash-icon {
        width: 16px;
        height: 16px;
        margin-right: 0.25rem;
        color: #ffffff;
    }

    .separator-line {
        width: 100%;
        height: 1px;
        background-color: #3f3f3f;
        margin: 8px 0;
    }

    .order-list {
        padding-left: 0;
        list-style: none;
        margin-bottom: 0;
        max-height: 120px;
        overflow-y: auto;
    }

    .order-list li {
        padding: 2px 0;
        color: #ffffff;
        display: flex;
        align-items: center;
    }

    .order-icon {
        width: 16px;
        height: 16px;
        margin-right: 0.5rem;
    }

    .order-icon.green {
        color: #00FF7F;
    }

    .order-icon.orange {
        color: #F97316;
    }

    .order-list::-webkit-scrollbar {
        width: 8px;
    }

    .order-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .order-list::-webkit-scrollbar-thumb {
        background: #1e1e1e;
        border-radius: 10px;
    }

    .order-list::-webkit-scrollbar-thumb:hover {
        background: #2a2a2a;
    }

    .order-list::-webkit-scrollbar-button {
        background: #1e1e1e;
        height: 0;
    }

    .order-list {
        scrollbar-width: thin;
        scrollbar-color: #1e1e1e transparent;
    }

    .quantity {
        color: #e0e0e0;
        margin-left: 5px;
    }

    .price-container {
        color: #ffffff;
        font-weight: 600;
    }

    .price {
        color: #ffffff;
    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .carrello-header-info {
        background-color: #1e1e1e;
        padding: 10px;
        text-align: center;
        font-size: 1rem;
        color: #00FF7F;
        border: 2px solid #00FF7F;
        background-color: rgba(0, 255, 127, 0.2);
        margin-bottom: 10px;
        position: sticky;
        border-radius: 15px;
        top: 5px;
        font-weight: 700;
        z-index: 5;
        margin-left: 25px;
        margin-right: 25px;
    }

    /* Media query per schermi piccoli */
    @media (max-width: 576px) {
        .ordini-container.container {
            padding-left: 10px;
            padding-right: 10px;
        }

        .ordini-content {
            padding: 0 10px 70px;
            width: calc(100% - 20px);
            margin-left: 10px;
            height: 700px;
            padding-top: 50px !important;
        }

        .order-card {
            margin-bottom: 4px;
        }

        .card-body {
            padding: 8px;
        }

        .card-title {
            font-size: 0.95rem;
        }

        .time-text {
            font-size: 0.7rem;
        }

        .order-list li {
            font-size: 0.85rem;
        }

        .price-container, .price {
            font-size: 0.85rem;
        }

        .table-text {
            font-size: 0.85rem;
        }
    }

    /* Media query per schermi grandi */
    @media (min-width: 576px) {
        .ordini-content {
            padding: 0 15px 70px;
            width: calc(100% - 30px);
            margin-left: 15px;
            height: calc(100vh - 10px);
            padding-bottom: 150px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        lucide.createIcons();
    });
</script>

<link rel="stylesheet" href="assets/css/ordini.css">
<script src="assets/script.js"></script>
<script src="assets/js/ordini.js"></script>