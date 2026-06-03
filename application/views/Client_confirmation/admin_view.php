<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Client Confirmation Details</h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo base_url('index.php/Client_confirmation'); ?>" class="btn btn-secondary float-right">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Confirmation #<?php echo $confirmation->client_confirmation_id; ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Client Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name:</th>
                                    <td><?php echo $confirmation->client_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $confirmation->client_email; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $confirmation->client_phone; ?></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <?php
                                        $statusClass = '';
                                        switch($confirmation->confirmation_status) {
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
                                        <span class="badge <?php echo $statusClass; ?>"><?php echo ucfirst($confirmation->confirmation_status); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Confirmation Date:</th>
                                    <td><?php echo $confirmation->confirmation_date ? date('d-m-Y H:i', strtotime($confirmation->confirmation_date)) : '-'; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Client Comments</h4>
                            <div class="p-3 border rounded">
                                <?php echo $confirmation->client_comments ? nl2br($confirmation->client_comments) : 'No comments'; ?>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h4>Confirmed Itinerary</h4>
                    <?php if (!empty($confirmation->days)): ?>
                        <?php foreach ($confirmation->days as $day): ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5><?php echo $day->quotation_properties_days_day; ?> - <?php echo $day->destination_name; ?></h5>
                                </div>
                                <div class="card-body">
                                    <h6>Confirmed Property</h6>
                                    <p>Property ID: <?php echo $day->confirmed_quotation_properties_id_fk; ?></p>
                                    
                                    <?php if (!empty($day->rooms)): ?>
                                        <h6 class="mt-3">Confirmed Room Categories</h6>
                                        <ul>
                                            <?php foreach ($day->rooms as $room): ?>
                                                <li><?php echo $room->properties_room_category_name; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-muted">No room categories confirmed</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No itinerary details available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
