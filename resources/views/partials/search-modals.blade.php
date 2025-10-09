<!-- Calendar Modal for Departure -->
<div class="modal fade" id="departureCalendar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Departure Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="calendar-container">
                    <!-- Calendar implementation would go here -->
                    <p class="text-center text-muted">Calendar functionality to be implemented</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calendar Modal for Return -->
<div class="modal fade" id="returnCalendar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Return Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="calendar-container">
                    <!-- Calendar implementation would go here -->
                    <p class="text-center text-muted">Calendar functionality to be implemented</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Passenger Selection Modal -->
<div class="modal fade" id="passengerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Passengers & Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="passenger-selection">
                    <div class="row mb-3">
                        <div class="col-8">
                            <label>Adults (12+ years)</label>
                        </div>
                        <div class="col-4">
                            <select class="form-select" name="adults">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-8">
                            <label>Class</label>
                        </div>
                        <div class="col-4">
                            <select class="form-select" name="class">
                                <option value="economy" selected>Economy</option>
                                <option value="business">Business</option>
                                <option value="first">First</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Apply</button>
                </div>
            </div>
        </div>
    </div>
</div>