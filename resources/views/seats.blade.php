<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .seat {
            display: inline-block;
            margin: 5px;
            width: 30px;
            height: 30px;
            background-color: #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .selected {
            background-color: #ff0000;
        }

        .modal-body {
            text-align: center;
        }
    </style>
</head>

<body>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#seatModal">
        Select Seats
    </button>

    <!-- Seat Modal -->
    <div class="modal fade" id="seatModal" tabindex="-1" role="dialog" aria-labelledby="seatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seatModalLabel">Select Seats</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="seatForm" action={{ route('lugares') }} method="POST">
                        @csrf
                        <div id="seatContainer">
                            <!-- Seats will be dynamically generated here -->
                        </div>
                        <input type="hidden" name="selectedSeats" id="selectedSeats">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="seatForm">Book Seats</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Number of rows and columns in the cinema
        const numRows = 5;
        const numCols = 8;

        // Array to store selected seat IDs
        const selectedSeats = [];

        // Generate seats dynamically
        function generateSeats() {
            const seatContainer = document.getElementById("seatContainer");

            for (let row = 1; row <= numRows; row++) {
                for (let col = 1; col <= numCols; col++) {
                    const seat = document.createElement("div");
                    seat.classList.add("seat");
                    seat.dataset.seat = `${row}-${col}`;
                    seat.id = `seat-${row}-${col}`;
                    seat.addEventListener("click", toggleSeat);
                    seatContainer.appendChild(seat);
                }

                seatContainer.appendChild(document.createElement("br"));
            }
        }

        // Toggle seat selection
        function toggleSeat(event) {
            const seat = event.target;

            if (seat.classList.contains("selected")) {
                seat.classList.remove("selected");
                const seatIndex = selectedSeats.indexOf(seat.id);
                if (seatIndex > -1) {
                    selectedSeats.splice(seatIndex, 1);
                }
            } else {
                seat.classList.add("selected");
                selectedSeats.push(seat.id);
            }

            updateSelectedSeatsInput();
        }

        // Update the hidden input field with selected seat IDs
        function updateSelectedSeatsInput() {
            const selectedSeatsInput = document.getElementById("selectedSeats");
            selectedSeatsInput.value = JSON.stringify(selectedSeats);
        }

        // Initialize the seat selection modal
        function initializeSeatModal() {
            generateSeats();
        }

        // Event listener for when the modal is shown
        $('#seatModal').on('show.bs.modal', function() {
            initializeSeatModal();
        });

        // Event listener for when the modal is hidden
        $('#seatModal').on('hidden.bs.modal', function() {
            document.getElementById("seatContainer").innerHTML = "";
            selectedSeats.length = 0;
            updateSelectedSeatsInput();
        });
    </script>
</body>

</html>
