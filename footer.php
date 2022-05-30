<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package figbros
 */
$footer_logo = get_field('footer_logo', 'option');
$footer_address = get_field('footer_address', 'option');
$footer_telephone = get_field('footer_telephone', 'option');
$footer_email = get_field('footer_email', 'option');
?>
</main>
<!-- /.footer start  -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- /.logo-copyright start -->
            <div class="col-lg-4 col-md-4 col-sm-12 text-lg-left text-md-left text-sm-center logo-copyright">
                <a href="<?php bloginfo('url');?>">
                    <img src="<?php echo $footer_logo;?>" class="img-fluid" alt="Fig Bros"/>
                </a>
                <p class="copyright m-0">© Copyright <?php echo date('Y');?> Fig Bros</p>
                <p>Website by <a href="">CixxFive</a></p>
            </div>
            <!-- /.logo-copyright end -->
            <!-- /.footer-address start -->
            <div class="col-lg-6 col-md-5 col-sm-12 footer-address">
                <ul class="list-unstyled m-0 p-0">
                    <li class=" d-lg-flex d-md-flex align-items-center"><i class="zmdi zmdi-pin"></i><?php echo $footer_address;?></li>
                    <li class="d-lg-flex d-md-flex align-items-center"><i class="zmdi zmdi-phone"></i><a href="tel:<?php echo $footer_telephone;?>"><?php echo $footer_telephone;?></a></li>
                    <li class="d-lg-flex d-md-flex align-items-center"><i class="zmdi zmdi-email"></i><a href="mailto:<?php echo $footer_email;?>"><?php echo $footer_email;?></a></li>
                </ul>
            </div>
            <!-- /.footer-address end -->
            <!-- /.footer-nav start -->
            <div class="col-lg-2 col-md-3 col-sm-12 footer-nav">
                <?php
                wp_nav_menu( array(
                    'menu_class'        => "list-unstyled m-0 p-0 text-uppercase",
                    'container'         => "",
                    'theme_location'    => 'menu-2'
                ) );
                ?>
            </div>
            <!-- /.footer-nav end -->
        </div>
    </div>

</footer>
<!-- /.footer end  -->
</div><!-- /.wrapper -->


<!-- search model  -->
<div class="modal fade bd-example-modal-lg search-model" id="search-model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Search product</h4>
                <a href="" class="close" data-dismiss="modal" aria-label="Close"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="search-box">
                    <form class="form-inline" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="input-group ">
                            <input type="hidden" name="post_type" value="product" />
                            <input type="hidden" name="cat_search" value="1" />
                            <input type="text" class="form-control" name="s_terms" id="auto_search" placeholder="Hot Sauces">
                            <button type="submit" class=" search-btn"><i class="zmdi zmdi-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="filter-box" id="fbx">
                    <!--<table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><a href=""> Pepper Sauce</a></td>

                        </tr>
                        <tr>
                            <td><a href="">Hot Sauce</a></td>

                        </tr>
                        <tr>
                            <td><a href="">Hot Pepper Sauce</a></td>

                        </tr>
                        </tbody>
                    </table>-->
                </div>

            </div>

        </div>
    </div>
</div>
<!-- /.search model end -->
<!-- add_cart model  -->
<div class="modal fade bd-example-modal-lg addCartModal " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ml-auto">
                <a href="javascript:void(0);" class="close clsbtn" data-dismiss="modal" aria-label="Close"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="modal-body">
                <!--<form id="add_payment_method" method="post">-->
                    <div class="payment_box payment_method_authorize_net_cim_credit_card" style="">
                        <fieldset id="wc-authorize-net-cim-credit-card-credit-card-form">
                            <div class="">
                                <p class=" validate-required woocommerce-validated" id="wc-authorize-net-cim-credit-card-account-number_field" data-priority="">
                                    <label for="wc-authorize-net-cim-credit-card-account-number2" class="">
                                        Card Number&nbsp;<span style="color: red" class="required" title="required">*</span>
                                    </label>
                                    <span class="woocommerce-input-wrapper">
                                        <input type="tel" class="input-text" name="" id="wc-authorize-net-cim-credit-card-account-number2" placeholder="•••• •••• •••• ••••" value="4007000000027" autocomplete="cc-number" autocorrect="no" autocapitalize="no" spellcheck="no" maxlength="20">
                                    </span>
                                </p>
                                <p class=" validate-required woocommerce-validated" id="wc-authorize-net-cim-credit-card-expiry_field" data-priority="">
                                    <label for="wc-authorize-net-cim-credit-card-expiry2" class="">
                                        Expiration (MM/YY)&nbsp;<span style="color: red" class="required" title="required">*</span>
                                    </label>
                                    <span class="woocommerce-input-wrapper">
                                        <input type="text" class="input-text" name="wc-authorize-net-cim-credit-card-expiry2" id="wc-authorize-net-cim-credit-card-expiry2" placeholder="MM / YY" value="01/20" autocomplete="cc-exp" autocorrect="no" autocapitalize="no" spellcheck="no">
                                    </span>
                                </p>
                                <p class=" validate-required woocommerce-validated" id="wc-authorize-net-cim-credit-card-csc_field" data-priority="">
                                    <label for="wc-authorize-net-cim-credit-card-csc2" class="">
                                        Card Security Code&nbsp;<span style="color: red" class="required" title="required">*</span>
                                    </label>
                                    <span class="woocommerce-input-wrapper">
                                        <input type="tel" class="input-text" name="" id="wc-authorize-net-cim-credit-card-csc2" placeholder="CSC" value="123" autocomplete="off" autocorrect="no" autocapitalize="no" spellcheck="no" maxlength="4">
                                    </span>
                                </p>
                                <div class="clear"></div>
                                <p class=" woocommerce-validated">
                                    <input name="submit-btn" class=" btn alt wc-forward text-uppercase sub_and_place_ord" type="submit" value="Submit And Place Order" >
                                </p>
                                <div class="clear"></div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.add_cart model end -->
<!-- add_cart model  -->
<div class="modal fade bd-example-modal-lg add_cart "  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a href="" class="close" data-dismiss="modal" aria-label="Close"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="card-box text-center">
                    <a href=""> <img src="<?php echo bloginfo('template_url');?>/images/add-to-cart.png" alt=""></a>
                    <p> Your product is added to cart</p>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.add_cart model end -->


<div class="modal fade confrimModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Are you sure, you want to delete this card?</h4>
            </div>
            <div class="modal-footer d-block">
                <button type="button" class="btn  yes float-left text-uppercase">Confirm</button>
                <button type="button" class="btn  no float-right text-uppercase">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- add_cart model  -->
<div class="modal fade bd-example-modal-lg addressModal" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="text-uppercase">Update ADDRESS</h4>
                <a href="" class="close" data-dismiss="modal" aria-label="Close"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="modal-body">
                <form action="" class="edit_billing_address">
                    <?php
                        $fields = WC()->checkout()->checkout_fields;
                        foreach ( $fields['billing'] as $key => $field ) {
                            woocommerce_form_field( $key, $field, WC()->checkout()->get_value( $key ) );
                        }
                    ?>
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" name="related_order_id" id="related_order_id" value="">
                    <input type="hidden" name="default_order" id="default_order" value="">
                    <p class="text-center mt-4 update_address" ><button type="submit" class="btn text-uppercase " name="submit" style="width: auto" >Submit</button></p>
                </form>
                <!--<form action="">
                    <div class="woocommerce-billing-fields__field-wrapper wbfrmwrap" style="display: block">
                        <p class=" validate-required first-name float-left" id="billing_first_name_field" data-priority="10">
                            <label for="billing_first_name" class="">First name&nbsp;<span class="required" title="required" style="color: #ff2222">*</span>
                            </label>
                            <span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name"></span>
                        </p>
                        <p class="validate-required last-name float-right" id="billing_last_name_field" data-priority="20">
                            <label for="billing_last_name" class="">Last name&nbsp;<span class="required" title="required" style="color: #ff2222">*</span>
                            </label>
                            <span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name"></span>
                        </p>
                        <div class="clearfix"></div>
                        <p class="address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40"><label for="billing_country" class="">Country&nbsp;<span class="required" title="required" style="color: #ff2222">*</span></label><span class="woocommerce-input-wrapper"><select name="billing_country" id="billing_country" class="country_to_state country_select select2-hidden-accessible" autocomplete="country" tabindex="-1" aria-hidden="true"><option value="">Select a country…</option><option value="AX">Åland Islands</option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD" selected="selected">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="PW">Belau</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BQ">Bonaire, Saint Eustatius and Saba</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo (Brazzaville)</option><option value="CD">Congo (Kinshasa)</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CW">Curaçao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="CI">Ivory Coast</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao S.A.R., China</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="KP">North Korea</option><option value="MK">North Macedonia</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PS">Palestinian Territory</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="ST">São Tomé and Príncipe</option><option value="BL">Saint Barthélemy</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="SX">Saint Martin (Dutch part)</option><option value="MF">Saint Martin (French part)</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia/Sandwich Islands</option><option value="KR">South Korea</option><option value="SS">South Sudan</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom (UK)</option><option value="US">United States (US)</option><option value="UM">United States (US) Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VG">Virgin Islands (British)</option><option value="VI">Virgin Islands (US)</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">    </span></span>
                        </p>
                        <p class=" address-field validate-required" id="billing_address_1_field" data-priority="50"><label for="billing_address_1" class="">Street address&nbsp;<span class="required" title="required" style="color: #ff2222">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="House number and street name" value="" autocomplete="address-line1" data-placeholder="House number and street name"></span>
                        </p>
                        <p class="address-field validate-required" id="billing_city_field" data-priority="70" data-o_class=" address-field validate-required"><label for="billing_city" class="">Town / City&nbsp;<span class="required" title="required" style="color: #ff2222">*</span></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="" value="" autocomplete="address-level2"></span></p>
                        <p class=" address-field validate-required validate-state" id="billing_state_field" data-priority="80" data-o_class=" address-field validate-required validate-state"><label for="billing_state" class="">District&nbsp;<span class="required" title="required" style="color: #ff2222">*</span></label><span class="woocommerce-input-wrapper"><select name="billing_state" id="billing_state" class="state_select select2-hidden-accessible" autocomplete="address-level1" data-placeholder="Select an option…" tabindex="-1" aria-hidden="true"><option value="">Select an option…</option><option value="BD-05">Bagerhat</option><option value="BD-01">Bandarban</option><option value="BD-02">Barguna</option><option value="BD-06">Barishal</option><option value="BD-07">Bhola</option><option value="BD-03">Bogura</option><option value="BD-04">Brahmanbaria</option><option value="BD-09">Chandpur</option><option value="BD-10">Chattogram</option><option value="BD-12">Chuadanga</option><option value="BD-11">Cox's Bazar</option><option value="BD-08">Cumilla</option><option value="BD-13">Dhaka</option><option value="BD-14">Dinajpur</option><option value="BD-15">Faridpur </option><option value="BD-16">Feni</option><option value="BD-19">Gaibandha</option><option value="BD-18">Gazipur</option><option value="BD-17">Gopalganj</option><option value="BD-20">Habiganj</option><option value="BD-21">Jamalpur</option><option value="BD-22">Jashore</option><option value="BD-25">Jhalokati</option><option value="BD-23">Jhenaidah</option><option value="BD-24">Joypurhat</option><option value="BD-29">Khagrachhari</option><option value="BD-27">Khulna</option><option value="BD-26">Kishoreganj</option><option value="BD-28">Kurigram</option><option value="BD-30">Kushtia</option><option value="BD-31">Lakshmipur</option><option value="BD-32">Lalmonirhat</option><option value="BD-36">Madaripur</option><option value="BD-37">Magura</option><option value="BD-33">Manikganj </option><option value="BD-39">Meherpur</option><option value="BD-38">Moulvibazar</option><option value="BD-35">Munshiganj</option><option value="BD-34">Mymensingh</option><option value="BD-48">Naogaon</option><option value="BD-43">Narail</option><option value="BD-40">Narayanganj</option><option value="BD-42">Narsingdi</option><option value="BD-44">Natore</option><option value="BD-45">Nawabganj</option><option value="BD-41">Netrakona</option><option value="BD-46">Nilphamari</option><option value="BD-47">Noakhali</option><option value="BD-49">Pabna</option><option value="BD-52">Panchagarh</option><option value="BD-51">Patuakhali</option><option value="BD-50">Pirojpur</option><option value="BD-53">Rajbari</option><option value="BD-54">Rajshahi</option><option value="BD-56">Rangamati</option><option value="BD-55">Rangpur</option><option value="BD-58">Satkhira</option><option value="BD-62">Shariatpur</option><option value="BD-57">Sherpur</option><option value="BD-59">Sirajganj</option><option value="BD-61">Sunamganj</option><option value="BD-60">Sylhet</option><option value="BD-63">Tangail</option><option value="BD-64">Thakurgaon</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"></span></span>
                        </p>
                        <p class="address-field validate-postcode" id="billing_postcode_field" data-priority="90" data-o_class=" address-field validate-postcode"><label for="billing_postcode" class="">Postcode / ZIP</label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_postcode" id="billing_postcode" placeholder="" value="" autocomplete="postal-code"></span></p>
                        <p class=" validate-required validate-email mb-4" id="billing_email_field" data-priority="110"><label for="billing_email" class="">Email address&nbsp;<span class="required" title="required" style="color: #ff2222">*</span></label><span class="woocommerce-input-wrapper"><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="" value="" autocomplete="email username"></span></p>
                        <p class=" validate-required validate-email text-center" ><button type="submit" class="btn text-uppercase " name="submit" style="width: auto" >Submit</button></p>
                    </div>
                </form>-->
            </div>
        </div>
    </div>
</div>
<!-- /.add_cart model end -->

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<?php wp_footer(); ?>

</body>
</html>
