    <section class="background-gray-lightest">
        <div id="contact" class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="text-center">
                        <div class="icon"><i class="pe-7s-mail-open-file"></i></div>
                        <h2 class="heading margin-bottom">Kontakt forma</h2>
                    </div>
                    <p class="text-muted">Ukoliko imate pitanja ili sugestije, budite slobodni da mi pišete.</p>
                    <form action="" method="post" id="form_contact">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tbFN_contact">Ime</label>
                                    <input id="tbFN_contact" name="tbFN_contact" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tbLN_contact">Prezime</label>
                                    <input id="tbLN_contact" name="tbLN_contact" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tbEmail_contact">E-mail</label>
                                    <input id="tbEmail_contact" name="tbEmail_contact" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tbTitle_contact">Naslov</label>
                                    <input id="tbTitle_contact" name="tbTitle_contact" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="taMsg_contact">Poruka</label>
                                    <textarea id="taMsg_contact" name="taMsg_contact" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="button" id="btnContact" name="btnContact" value="Contact" class="btn btn-primary" onclick="conCheck();"><i class="fa fa-envelope-o"></i> Pošalji</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center" id="contactInfo"></div>
    </section>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVHsEpU4NGN1fknIQtadGTDYXKrCNnEfk&callback=initMap" async defer></script>