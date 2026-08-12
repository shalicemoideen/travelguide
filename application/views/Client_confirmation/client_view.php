<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Quotation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .confirmation-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .option-card {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .option-card:hover {
            border-color: #0d6efd;
        }
        .option-card.selected {
            border-color: #0d6efd;
            background-color: #f0f7ff;
        }
        .day-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .property-option {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
        }
        .property-option.selected {
            border-color: #0d6efd;
            background-color: #f0f7ff;
        }
        .room-option {
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 5px;
            cursor: pointer;
        }
        .room-option.selected {
            border-color: #0d6efd;
            background-color: #e7f1ff;
        }
        .btn-submit {
            background-color: #0d6efd;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 8px;
        }
        .btn-submit:hover {
            background-color: #0b5ed7;
        }
        .header-section {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="header-section">
            <h1>Confirm Your Quotation</h1>
            <p class="text-muted">Quotation #<?php echo $quotation->quotation_number; ?></p>
            <p class="text-muted">Guest: <?php echo $quotation->guest_name; ?></p>
        </div>

        <form id="confirmationForm">
            <input type="hidden" name="token" value="<?php echo $confirmation->confirmation_token; ?>">

            <!-- Client Details -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control" name="client_name" value="<?php echo $confirmation->client_name; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="client_email" value="<?php echo $confirmation->client_email; ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone Number *</label>
                    <input type="text" class="form-control" name="client_phone" value="<?php echo $confirmation->client_phone; ?>" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Additional Comments</label>
                <textarea class="form-control" name="client_comments" rows="3"><?php echo $confirmation->client_comments; ?></textarea>
            </div>

            <!-- Options Selection -->
            <h3 class="mb-3">Select Your Preferred Option</h3>
            <div id="optionsContainer">
                <?php foreach ($options as $index => $option): ?>
                    <div class="option-card" data-option-id="<?php echo $option->quotation_options_id; ?>" onclick="selectOption(<?php echo $option->quotation_options_id; ?>)">
                        <h4>Option <?php echo $index + 1; ?> - <?php echo $option->quotation_options_name; ?></h4>
                        <p class="text-muted">Total Cost: <?php echo number_format($option->quotation_options_total_cost, 2); ?></p>

                        <div class="option-details" style="display: none;">
                            <?php foreach ($option->days as $day): ?>
                                <div class="day-section">
                                    <h5><?php echo $day->quotation_properties_days_day; ?> - <?php echo $day->destination_name; ?></h5>
                                    <p class="mb-2">Select Property:</p>
                                    <?php foreach ($day->properties as $property): ?>
                                        <div class="property-option" 
                                             data-day="<?php echo $day->quotation_properties_days_day; ?>" 
                                             data-day-id="<?php echo $day->quotation_properties_days_id; ?>"
                                             data-property-id="<?php echo $property->quotation_properties_id; ?>"
                                             onclick="selectProperty(event, <?php echo $property->quotation_properties_id; ?>, '<?php echo $day->quotation_properties_days_day; ?>')">
                                            <h6><?php echo $property->properties_name; ?></h6>
                                            <p class="mb-1">Select Room Category:</p>
                                            <?php foreach ($property->rooms as $room): ?>
                                                <div class="room-option" 
                                                     data-property-id="<?php echo $property->quotation_properties_id; ?>" 
                                                     data-room-id="<?php echo $room->quotation_properties_rooms_id; ?>"
                                                     onclick="selectRoom(event, <?php echo $room->quotation_properties_rooms_id; ?>, <?php echo $property->quotation_properties_id; ?>)">
                                                    <?php echo $room->properties_room_category_name; ?> - <?php echo number_format($room->total_room_cost, 2); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-submit">Submit Confirmation</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedOptionId = null;
        let selectedProperties = {};
        let selectedRooms = {};

        function selectOption(optionId) {
            selectedOptionId = optionId;
            
            // Remove selected class from all options
            document.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            document.querySelector(`.option-card[data-option-id="${optionId}"]`).classList.add('selected');
            
            // Show details for selected option
            document.querySelectorAll('.option-details').forEach(details => {
                details.style.display = 'none';
            });
            document.querySelector(`.option-card[data-option-id="${optionId}"] .option-details`).style.display = 'block';
        }

        function selectProperty(event, propertyId, day) {
            event.stopPropagation();
            
            // Remove selected class from all properties in this day
            document.querySelectorAll(`.property-option[data-day="${day}"]`).forEach(prop => {
                prop.classList.remove('selected');
            });
            
            // Add selected class to clicked property
            event.currentTarget.classList.add('selected');
            
            // Store selection
            const dayKey = 'day_' + day.replace('Day ', '');
            selectedProperties[dayKey] = propertyId;
        }

        function selectRoom(event, roomId, propertyId) {
            event.stopPropagation();
            
            // Toggle selection
            if (selectedRooms[propertyId] && selectedRooms[propertyId].includes(roomId)) {
                selectedRooms[propertyId] = selectedRooms[propertyId].filter(id => id !== roomId);
                event.currentTarget.classList.remove('selected');
            } else {
                if (!selectedRooms[propertyId]) {
                    selectedRooms[propertyId] = [];
                }
                selectedRooms[propertyId].push(roomId);
                event.currentTarget.classList.add('selected');
            }
        }

        // Pre-select the previously confirmed option / properties / rooms on load.
        const confirmedSelection = <?php echo json_encode($confirmed_selection); ?>;

        function applyConfirmedSelection() {
            if (!confirmedSelection || !confirmedSelection.option_id) {
                return;
            }

            const optionCard = document.querySelector(`.option-card[data-option-id="${confirmedSelection.option_id}"]`);
            if (!optionCard) {
                return;
            }

            selectOption(confirmedSelection.option_id);

            // Pre-select property per day
            const props = confirmedSelection.properties || {};
            Object.keys(props).forEach(dayId => {
                const propertyId = props[dayId];
                const propEl = optionCard.querySelector(`.property-option[data-day-id="${dayId}"][data-property-id="${propertyId}"]`);
                if (propEl) {
                    const day = propEl.getAttribute('data-day');
                    document.querySelectorAll(`.property-option[data-day="${day}"]`).forEach(p => p.classList.remove('selected'));
                    propEl.classList.add('selected');
                    const dayKey = 'day_' + day.replace('Day ', '');
                    selectedProperties[dayKey] = parseInt(propertyId, 10);
                }
            });

            // Pre-select rooms per property
            const rooms = confirmedSelection.rooms || {};
            Object.keys(rooms).forEach(propertyId => {
                (rooms[propertyId] || []).forEach(roomId => {
                    const roomEl = optionCard.querySelector(`.room-option[data-property-id="${propertyId}"][data-room-id="${roomId}"]`);
                    if (roomEl) {
                        roomEl.classList.add('selected');
                        if (!selectedRooms[propertyId]) {
                            selectedRooms[propertyId] = [];
                        }
                        selectedRooms[propertyId].push(parseInt(roomId, 10));
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', applyConfirmedSelection);

        document.getElementById('confirmationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!selectedOptionId) {
                alert('Please select an option');
                return;
            }
            
            if (Object.keys(selectedProperties).length === 0) {
                alert('Please select at least one property for each day');
                return;
            }
            
            const formData = new FormData(this);
            formData.append('selected_option_id', selectedOptionId);
            formData.append('selected_properties', JSON.stringify(selectedProperties));
            formData.append('selected_rooms', JSON.stringify(selectedRooms));
            
            fetch('<?php echo base_url('index.php/Client_confirmation/submit_confirmation'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    alert('Thank you! Your confirmation has been submitted successfully.');
                    window.location.href = '<?php echo base_url(); ?>';
                } else {
                    alert(data.message || 'An error occurred. Please try again.');
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
