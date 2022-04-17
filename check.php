<fieldset>
                            <legend>Membership Registration</legend>

                            <div class="form-group">
                                <label> First name </label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter your firstname" onkeyup="this.value = this.value.toUpperCase();" required>
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="lastname" class="form-control checking_email" placeholder="Enter your lastname" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter your address" required>
                            </div>
                            <div class="form-group">
                                <label>	</label>
                                <input type="number" name="contact" class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Enter Contact number" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['firstname']; ?>" placeholder="Enter your valid Email address">
                                <small class="error_email" style="color: red;"></small>
                            </div>
                            <div class="form-group">
                                <label>Membership join</label>
                                <input type="date" name="membership_start" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <label>Membership Type:</label>
                                    <label class="container">Annual
                                        <input type="radio" name="type" value="Annual" />
                                    </label>
                                    <label class="container">Senior/Student
                                        <input type="radio" name="type" value="Senior/Student" />
                                    </label>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <label>Import Picture</label>
                                    <input type="file" name="proof" class="form-control-file" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note/Comment</label>
                                <textarea type="text" name="note" class="form-control" cols="2" rows="2" required></textarea>
                            </div>

                            <button type="submit" name="register" class="btn btn-info">Save</button>
                        </fieldset>
                    </form>