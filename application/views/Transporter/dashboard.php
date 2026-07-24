<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Transporter Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($transporter)): ?>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($transporter->transporter_name); ?></p>
                            <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($transporter->transporter_address)); ?></p>
                            <p><strong>Contact Person:</strong> <?php echo htmlspecialchars($transporter->transporter_contact_person_name1); ?></p>
                            <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($transporter->transporter_contact_person_contact_num1); ?></p>
                            <p><strong>Login Username:</strong> <?php echo htmlspecialchars($transporter->user_name); ?></p>
                        <?php else: ?>
                            <div class="alert alert-warning">No transporter profile linked to this login.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
