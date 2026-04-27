<?php
session_start();
 include 'common/config.php';
 include 'common/header.php'; ?>
<style>
    :root {
        --gold: #d4af37;
        --dark-blue: #1a2b48;
    }
    

    .reservation-container {
        background: #f8f9fa;
        padding: 60px 0;
        min-height: 80vh;
    }

    /* Card Styling */
    .dashboard-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        background: #fff;
    }

    /* Table Styling */
    .table thead {
        background-color: var(--dark-blue);
        color: #fff;
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        padding: 20px;
        border: none;
    }

    .table tbody td {
        padding: 20px;
        vertical-align: middle;
        color: #444;
        border-bottom: 1px solid #f1f1f1;
    }

    .room-link {
        color: var(--dark-blue);
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }
    .room-link:hover {
        color: var(--gold);
    }

    .status-badge {
        padding: 8px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    .bg-confirmed { background: #e8f5e9; color: #2e7d32; }
    .bg-cancelled { background: #ffebee; color: #c62828; }
    .bg-pending   { background: #fff3e0; color: #ef6c00; }

    
    .btn-cancel {
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 8px 20px;
        transition: 0.3s;
        border: 2px solid #dc3545;
        color: #dc3545;
        background: transparent;
    }
    .btn-cancel:hover {
        background: #dc3545;
        color: #fff;
        transform: scale(1.05);
    }

    .empty-state {
        text-align: center;
        padding: 50px;
    }
     .back_re {
        background: #615e5e;
        color: #fff;
        padding: 60px 0;
        margin-bottom: 50px;
}
</style>
<div class="back_re">
   <div class="container">
      <h2 class="text-center">Cancel Booking</h2>
      
   </div>
</div>
<div class="reservation-container">
    <div class="container">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold mb-0" style="color: var(--dark-blue);">My Reservations</h3>
                <p class="text-muted small">Manage your upcoming and past stays</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="room.php" class="btn btn-sm btn-dark px-4 py-2 shadow-sm">Book New Room</a>
            </div>
        </div>

        <div class="card dashboard-card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Room Details</th>
                            <th>Stay Duration</th>
                            <th>Guest Info</th>
                            <th>Status</th>
                            <th class="text-center">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php

    if (!isset($_SESSION['user_id'])) {
        echo "<tr><td colspan='5' class='text-center'>Please login to see bookings.</td></tr>";
    } else {
        $user_id = $_SESSION['user_id'];

        
        $query = "SELECT * FROM booking WHERE user_id = '$user_id' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);

       
        if (!$result) {
            echo "<tr><td colspan='5' class='text-center text-danger'>
                    Query Error: " . mysqli_error($conn) . "
                  </td></tr>";
        } else {
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['status'];
                    $status_class = ($status == "Confirmed") ? "bg-confirmed" : (($status == "Cancelled") ? "bg-cancelled" : "bg-pending");
    ?>
                    <tr>
                        <td>
                            <span class="room-link"><?php echo $row['name']; ?></span><br>
                            <small class="text-muted">Booking ID: #<?php echo $row['id']; ?></small>
                        </td>
                        <td>
                            <div class="small fw-bold text-dark">
                                <?php echo date('d M', strtotime($row['checkin'])); ?> - 
                                <?php echo date('d M Y', strtotime($row['checkout'])); ?>
                            </div>
                        </td>
                        <td>
                            <small class="d-block text-dark"><?php echo $row['guests']; ?> Guests</small>
                        </td>
                        <td>
                            <span class="status-badge <?php echo $status_class; ?>">
                                <?php echo $status; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($status != "Cancelled") : ?>
                                <button class="btn btn-cancel" onclick="confirmCancel(<?php echo $row['id']; ?>)">
                                    Cancel Stay
                                </button>
                            <?php else : ?>
                                <span class="text-muted small">Cancelled</span>
                            <?php endif; ?>
                        </td>
                    </tr>
    <?php
                } 
            } else {
                echo "<tr><td colspan='5' class='text-center p-5'>No bookings found. <a href='room.php'>Book now!</a></td></tr>";
            }
        }
    }
    ?>
</tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmCancel(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Kya aap wakayi apni booking cancel karna chahte hain? Ye wapas nahi li ja sakegi.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Cancel it!',
        cancelButtonText: 'Keep Booking'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "php/cancel_booking.php?id=" + id;
        }
    })
}
</script>
<?php include 'common/footer.php'; ?>