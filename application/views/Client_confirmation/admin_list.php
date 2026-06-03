<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Client Confirmations</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Client Confirmations</h3>
                </div>
                <div class="card-body">
                    <table id="confirmationTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Quotation #</th>
                                <th>Client Name</th>
                                <th>Client Email</th>
                                <th>Client Phone</th>
                                <th>Status</th>
                                <th>Confirmation Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($confirmations)): ?>
                                <?php foreach ($confirmations as $conf): ?>
                                    <tr>
                                        <td><?php echo $conf->client_confirmation_id; ?></td>
                                        <td><?php echo $conf->quotation_id_fk; ?></td>
                                        <td><?php echo $conf->client_name; ?></td>
                                        <td><?php echo $conf->client_email; ?></td>
                                        <td><?php echo $conf->client_phone; ?></td>
                                        <td>
                                            <?php
                                            $statusClass = '';
                                            switch($conf->confirmation_status) {
                                                case 'confirmed':
                                                    $statusClass = 'badge-success';
                                                    break;
                                                case 'rejected':
                                                    $statusClass = 'badge-danger';
                                                    break;
                                                default:
                                                    $statusClass = 'badge-warning';
                                            }
                                            ?>
                                            <span class="badge <?php echo $statusClass; ?>"><?php echo ucfirst($conf->confirmation_status); ?></span>
                                        </td>
                                        <td><?php echo $conf->confirmation_date ? date('d-m-Y H:i', strtotime($conf->confirmation_date)) : '-'; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('index.php/Client_confirmation/view_confirmation/' . $conf->client_confirmation_id); ?>" class="btn btn-sm btn-info">View Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No confirmations found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
