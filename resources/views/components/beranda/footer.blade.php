<footer class="footer_three">
    <div class="footer-top bg-dark3 pt-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title">About</h4>
                        <p class="text-capitalize mb-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis exercitation ullamco laboris<br><br>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                    </div>
                </div>
                <div class="col-lg-2 col-12">
                    <div class="widget">
                        <h4 class="footer-title">Link</h4>
                        <ul class="list list-arrow mb-30">
                            <li><a href="{{ route('news.index') }}">Berita</a></li>
                            <li><a href="{{ route('contact.index') }}">Kontak</a></li>
                            <li><a href="#">About</a></li>
                            {{-- <li><a href="#">FAQs</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Listing</a></li>
                            <li><a href="#">Membership</a></li>
                            <li><a href="#">Profile</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="widget">
                        <h4 class="footer-title">Info Kontak</h4>
                        <ul class="list list-unstyled mb-30">
                            <li> <i class="fa fa-map-marker"></i> {{ $dataWebsite->alamat ?? '' }}</li>
                            <li> <i class="fa fa-phone"></i> <span class="me-5"> {{ $dataWebsite->phone ?? '' }} </span></li>
                            <li> <i class="fa fa-envelope"></i> <span class="me-5">{{ $dataWebsite->email ?? '' }} </span></li>
                        </ul>
                        <div class="social-icons mt-30">
                            <ul class="list-unstyled d-flex gap-items-1">
                                <li><a href="{{ $dataWebsite->facebook ?? '#' }}" target="_blank" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ $dataWebsite->instagram ?? '#' }}" target="_blank" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="{{ $dataWebsite->youtube ?? '#' }}" target="_blank" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title">Subscribe</h4>
                        <p class="text-capitalize mb-20">Sign Up to our Newsletter and get the latest offers.</p>
                        <div class="mb-20">
                            <form class="" action="" method="post">
                                <input name="email" required="required" class="form-control" placeholder="Your Email Address" type="email">
                                <button name="submit" value="Submit" type="submit" class="btn btn-primary mt-5"> Get notified </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-dark3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 text-md-start text-center"> © <script>document.write(new Date().getFullYear())</script> <span class="text-white">{{ $dataWebsite->footer ?? '' }}</span></div>
                {{-- <div class="col-lg-6 col-md-6 mt-md-0 mt-20">
                    <ul class="payment-icon list-unstyled d-flex gap-items-1 justify-content-md-end justify-content-center">
                        <li class="ps-0">
                            <a href="javascript:;"><i class="fa fa-cc-amex" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cc-visa" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cc-paypal" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
