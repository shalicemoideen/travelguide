<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><b>Incentive Configuration</b></h4>
                <?php /* if ($this->session->userdata('user_type') == 'A'): ?>
                <button type="button" class="btn btn-primary btn-sm" id="btnAddSlab">
                    <i class="fas fa-plus"></i> Add Slab
                </button>
                <?php endif; */ ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle" id="incentiveSlabsTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Slab Label</th>
                                        <th>Min Profit (₹)</th>
                                        <th>Max Profit (₹)</th>
                                        <th>Type</th>
                                        <th>Incentive Value</th>
                                        <th>Deduction (₹)</th>
                                        <th>Preview Formula</th>
                                        <?php /* if ($this->session->userdata('user_type') == 'A'): ?>
                                        <th>Actions</th>
                                        <?php endif; */ ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; foreach ($slabs as $row): ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><b><?php echo htmlspecialchars($row->slab_label); ?></b></td>
                                        <td><?php echo number_format($row->min_profit, 2); ?></td>
                                        <td><?php echo $row->max_profit !== null ? number_format($row->max_profit, 2) : '<span class="badge bg-secondary">No limit</span>'; ?></td>
                                        <td>
                                            <?php if ($row->calculation_type == 'fixed'): ?>
                                                <span class="badge bg-success">Fixed</span>
                                            <?php else: ?>
                                                <span class="badge bg-info text-dark">Percentage</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row->calculation_type == 'fixed'): ?>
                                                ₹ <?php echo number_format($row->incentive_value, 2); ?>
                                            <?php else: ?>
                                                <?php echo number_format($row->incentive_value, 2); ?>%
                                            <?php endif; ?>
                                        </td>
                                        <td>₹ <?php echo number_format($row->deduction, 2); ?></td>
                                        <td class="text-muted" style="font-size:13px;">
                                            <?php if ($row->calculation_type == 'fixed'): ?>
                                                Incentive = ₹<?php echo number_format($row->incentive_value, 2); ?>
                                            <?php else: ?>
                                                Incentive = (Profit × <?php echo $row->incentive_value; ?>%) − ₹<?php echo number_format($row->deduction, 2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <?php /* if ($this->session->userdata('user_type') == 'A'): ?>
                                        <td>
                                            <button class="btn btn-warning btn-xs btnEdit"
                                                data-id="<?php echo $row->id; ?>"
                                                data-label="<?php echo htmlspecialchars($row->slab_label); ?>"
                                                data-min="<?php echo $row->min_profit; ?>"
                                                data-max="<?php echo $row->max_profit; ?>"
                                                data-type="<?php echo $row->calculation_type; ?>"
                                                data-value="<?php echo $row->incentive_value; ?>"
                                                data-deduction="<?php echo $row->deduction; ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-danger btn-xs btnDelete" data-id="<?php echo $row->id; ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <?php endif; */ ?>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-3" style="font-size:13px;">
                            <b>How incentive is calculated:</b><br>
                            The system checks the <b>Profit</b> (Quoted Amount − Cost) for each converted trip and applies the matching slab formula.
                            If the profit doesn't fall in any slab, incentive is <b>₹0</b>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add / Edit Modal -->
<div class="modal fade" id="slabModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slabModalTitle">Add Incentive Slab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="slab_id">
                <div class="mb-3">
                    <label class="form-label">Slab Label <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slab_label" placeholder="e.g. Upto 5000">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Min Profit (₹) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="slab_min" placeholder="0" min="0" step="0.01">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Max Profit (₹)</label>
                        <input type="number" class="form-control" id="slab_max" placeholder="Leave blank for no limit" min="0" step="0.01">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Calculation Type <span class="text-danger">*</span></label>
                    <select class="form-control" id="slab_type">
                        <option value="fixed">Fixed Amount</option>
                        <option value="percentage">Percentage of Profit</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" id="lblIncentiveValue">Incentive Amount (₹) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="slab_value" placeholder="e.g. 500" min="0" step="0.01">
                </div>
                <div class="mb-3" id="deductionRow">
                    <label class="form-label">Deduction (₹)</label>
                    <input type="number" class="form-control" id="slab_deduction" placeholder="e.g. 500" min="0" step="0.01" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btnSaveSlab">Save</button>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->
