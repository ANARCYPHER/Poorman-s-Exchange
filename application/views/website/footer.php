<?php
$settings = $this->db->select("*")
    ->get('setting')
    ->row();
?>


        <footer class="footer">
            <div class="footer-breadcrumbs">
                <div class="container">
                    <div class="breadcrumbs-row">
                        <ul class="f_breadcrumbs">
                            <li><a href="<?php echo base_url(); ?>"><span><?php echo display('home'); ?></span></a></li>
                            <li><a href="#"><span><?php echo isset($lang) && $lang =="french"?@$cat_info->cat_name_fr:@$cat_info->cat_name_en; ?></span></a></li>
                        </ul>
                        <div class="scroll-top" id="back-to-top">
                            <div class="scroll-top-text"><span><?php echo display('scroll_to_top'); ?></span></div>
                            <div class="scroll-top-icon"><i class="fa fa-angle-up"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.End of breadcrumbs -->
            <div class="action_btn_inner">
                <a href="<?php echo base_url('register'); ?>#tab1" class="action_btn">
                    <span class="action_title"><?php echo display('register'); ?></span>
                    <span class="lnr lnr-chevron-right action_icon"></span>
                    <span class="action_sub_title"><?php echo display('join_the_new_yera_of_cryptocurrency_exchange'); ?></span>
                </a>
                <a href="<?php echo base_url('register'); ?>#tab2" class="action_btn">
                    <span class="action_title"><?php echo display('sign_in'); ?></span>
                    <span class="lnr lnr-chevron-right action_icon"></span>
                    <span class="action_sub_title"><?php echo display('access_the_cryptocurrency_experience_you_deserve'); ?></span>
                </a>
            </div>
            <!-- /.End of action button -->
            <div class="main_footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="widget-contact">
                                <ul class="list-icon">
                                    <li><i class="fa fa-map-marker"></i> <?php echo $settings->description ?></li>
                                    <li><i class="fa fa-phone"></i> <?php echo $settings->phone ?> </li>
                                    <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $settings->email ?>"><?php echo $settings->email ?></a>
                                    </li>
                                    <li>
                                        <br><i class="fa fa-clock-o"></i><?php echo $settings->office_time ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-4 col-md-offset-1">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="footer-box">
                                        <h3 class="footer-title"><?php echo display('our_company'); ?></h3>
                                        <ul class="footer-list">
                        <?php
                            foreach ($category as $cat_key => $cat_value) {
                                if ($cat_value->menu==2 || $cat_value->menu==3) { 
                                     $cat_name = isset($lang) && $lang =="french"?$cat_value->cat_name_fr:$cat_value->cat_name_en;
                                     $cat_slug = $cat_value->slug;
                        ?>
                                    <li><a href="<?php echo base_url($cat_slug); ?>"><?php echo  $cat_name ?></a></li>
                        <?php
                                }                               
                            }
                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="footer-box">
                                        <h3 class="footer-title"><?php echo display('services'); ?></h3>
                                        <ul class="footer-list">
                                            <?php 

                                                foreach ($service as $ser_key => $ser_value) {

                                                    $ser_headline    =   isset($lang) && $lang =="french"?$ser_value->headline_fr:$ser_value->headline_en;
                                            ?>

                                                    <li><a href="<?php echo base_url("service/".$ser_value->slug); ?>"><?php echo $ser_headline ?></a></li>
                                            <?php

                                                }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="newsletter-box">
                                <h3 class="footer-title"><?php echo display('email_newslatter'); ?></h3>
                                <p><?php echo display('subscribe_to_our_newsletter'); ?></p>
                                <?php echo form_open('#','id="subscribeForm"  class="newsletter-form" name="subscribeForm" '); ?>
                                <form class='newsletter-form' action='#' method='post'>
                                    <input name="subscribe_email" placeholder="<?php echo display('email'); ?>" type="email">
                                    <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    <div class="envelope">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.End of main footer -->
            <div class="sub_footer">
                <div class="container">
                    <div class="logos-wrapper">
                        <div class="logos-row">
                            <div class="social-content">
                                <div class="social-row">
                                    <div class="social_icon">
                                        <?php foreach ($social_link as $key => $value) { ?>
                                        <a href="<?php echo $value->link; ?>" class=""><i class="fa fa-<?php echo $value->icon; ?>"></i></a>
                                        <?php } ?>
                                    </div>
                                    <div class="f-language">
                                        <select class="selectpicker lang-change" id="lang-changeF" data-width="fit">
                                            <option value="english" data-content='<span class="flag-icon flag-icon-us"></span> English' <?php echo isset($lang) && $lang =="english"?'Selected':''; ?>>English</option>
                                            <option value="french"  data-content='<span class="flag-icon flag-icon-<?php echo $web_language->flag; ?>"></span> <?php echo $web_language->name; ?>' <?php echo isset($lang) && $lang =="french"?'Selected':''; ?>> <?php echo $web_language->name; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="copyright">
                            <span>YyBvIGQgZSBsIGkgcyB0IC4gYyBj - <?php echo $settings->footer_text; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.End of sub footer -->
        </footer>
        <!-- /.End of footer -->

<!-- Home nad Coin Market Page Script -->
<?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='home' || $this->uri->segment(1)=='coinmarket') { ?>
        <style type="text/css">
            /*#crypto  table tbody tr td > .up {
                color: green;
            }

            #crypto  table tbody tr td > .down {
                color: red;
            }*/
            #crypto  table tbody tr.upbg {
                background-color: rgba(255, 78,34,.2);
            }

            #crypto  table tbody tr.downbg {
                background-color: rgba(37,37,142,0.2);
            }

            #crypto  table tbody tr td > .exchange {
                color: #42f492;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.js"></script>
        <script src="<?php echo base_url('assets/website/streamer/ccc-streamer-utilities.js'); ?>"></script>
        <script type="text/javascript">

        $(document).ready(function() {

            var currentPrice = {};
            var socket = io.connect('https://streamer.cryptocompare.com/');
            //Format: {SubscriptionId}~{ExchangeName}~{FromSymbol}~{ToSymbol}
            //Use SubscriptionId 0 for TRADE, 2 for CURRENT and 5 for CURRENTAGG
            //For aggregate quote updates use CCCAGG as market

            <?php 

            $coin_stream="";
            foreach ($cryptocoins as $coin_key => $coin_value) {
                $coin_stream .= "'5~CCCAGG~".$coin_value->Symbol."~USD',";
            }
            ?>
            var subscription = [<?php echo rtrim($coin_stream, ','); ?>];
            socket.emit('SubAdd', { subs: subscription });
            socket.on("m", function(message) {
                var messageType = message.substring(0, message.indexOf("~"));
                var res = {};
                if (messageType == CCC.STATIC.TYPE.CURRENTAGG) {
                    res = CCC.CURRENT.unpack(message);
                    dataUnpack(res);
                }
            });

            var dataUnpack = function(data) {
                var from = data['FROMSYMBOL'];
                var to = data['TOSYMBOL'];
                var fsym = CCC.STATIC.CURRENCY.getSymbol(from);
                var tsym = CCC.STATIC.CURRENCY.getSymbol(to);
                var pair = from + to;

                if (!currentPrice.hasOwnProperty(pair)) {
                    currentPrice[pair] = {};
                }

                for (var key in data) {
                    currentPrice[pair][key] = data[key];
                }

                if (currentPrice[pair]['LASTTRADEID']) {
                    currentPrice[pair]['LASTTRADEID'] = parseInt(currentPrice[pair]['LASTTRADEID']).toFixed(0);
                }
                currentPrice[pair]['CHANGE24HOUR'] = CCC.convertValueToDisplay(tsym, (currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']));
                currentPrice[pair]['CHANGE24HOURPCT'] = ((currentPrice[pair]['PRICE'] - currentPrice[pair]['OPEN24HOUR']) / currentPrice[pair]['OPEN24HOUR'] * 100).toFixed(2) + "%";;
                displayData(currentPrice[pair], from, tsym, fsym);
            };

            var displayData = function(current, from, tsym, fsym) {
                var priceDirection = current.FLAGS;
                for (var key in current) {
                    if (key == 'CHANGE24HOURPCT') {
                        $('#' + key + '_' + from).text(' (' + current[key] + ')');
                    }
                    else if (key == 'LASTVOLUMETO' || key == 'VOLUME24HOURTO') {
                        $('#' + key + '_' + from).text(CCC.convertValueToDisplay(tsym, current[key]));
                    }
                    else if (key == 'LASTVOLUME' || key == 'VOLUME24HOUR' || key == 'OPEN24HOUR' || key == 'OPENHOUR' || key == 'HIGH24HOUR' || key == 'HIGHHOUR' || key == 'LOWHOUR' || key == 'LOW24HOUR') {
                        $('#' + key + '_' + from).text(CCC.convertValueToDisplay(fsym, current[key]));
                    }
                    else {
                        $('#' + key + '_' + from).text(current[key]);
                    }
                }

                $('#PRICE_' + from).removeClass();
                $('#BGCOLOR_' + from).removeClass();
                if (priceDirection & 1) {
                    $('#PRICE_' + from).addClass("up");
                    $('#BGCOLOR_' + from).addClass("upbg");
                }
                else if (priceDirection & 2) {
                    $('#PRICE_' + from).addClass("down");
                    $('#BGCOLOR_' + from).addClass("downbg");
                }
                if (current['PRICE'] > current['OPEN24HOUR']) {
                    $('#CHANGE24HOURPCT_' + from).removeClass();
                    $('#CHANGE24HOURPCT_' + from).addClass("up");
                }
                else if (current['PRICE'] < current['OPEN24HOUR']) {
                    $('#CHANGE24HOURPCT_' + from).removeClass();
                    $('#CHANGE24HOURPCT_' + from).addClass("down");
                }
            };
        });

        </script>

        <!-- Sparkline Ajax -->
        <script type="text/javascript">
            $(function(){
                window.setTimeout(function(){
                    $( ".value_graph").text("Loading...");
                    $.ajax({
                            url: "<?php echo base_url('home/coingraphdata/'.$this->uri->segment(2)) ?>",
                            type: "GET",
                            dataType : "json",
                            success: function(result,status,xhr) {

                                var keys = Object.keys(result);
                                for(var i=0;i<keys.length;i++){
                                    var key = keys[i];
                                    $( "#GRAPH_"+key).text(result[key]);
                                    $('#GRAPH_'+key).sparkline('html', {type:'line', height:'40px', lineWidth:1, lineColor:'#35a947', fillColor:false, spotColor:'red'} );
                                }

                            },
                            error: function(xhr,status,error){
                                console.log("No Grap Found!!!");

                            }
                        });
                }, 500);
            });

        </script>
<?php } ?>
        <!-- jQuery -->
        <script src="<?php echo base_url('assets/website/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/sparkline.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/bootsnav.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/owl.carousel.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/wow.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/parallax-background.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/responsive.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/jquery.marquee.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/particles.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/jquery.magnific-popup.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/bootstrap-select.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/app.js'); ?>"></script>
        <script src="<?php echo base_url('assets/website/js/classie.min.js'); ?>"></script>

        <script src="<?php echo base_url('assets/website/js/custom.js'); ?>"></script>

        <!-- Calculator -->        
        <script type="text/javascript">
            $(function(){

                var cryptolistfrom;
                var cryptolistto;
                var amountfrom;
                var amountto;

                $("#convertfromcryptolist").on("change", function(event) {
                    event.preventDefault();
                    $( "#convertfromcrypto").val(1);
                    cryptolistfrom = $("#convertfromcryptolist").val(); 
                    cryptolistto = $("#converttocryptolist").val();

                    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym="+cryptolistfrom+"&tsyms="+cryptolistto+"", function(result) {
                        if (result[Object.keys(result)[0]]=='Error') {
                           alert("No Conversion Found!!!");
                        }
                        else {
                            $( "#converttocrypto").val(result[Object.keys(result)[0]]);
                        };
                    });
                });

                $("#converttocryptolist").on("change", function(event) {
                    event.preventDefault();
                    $( "#converttocrypto").val(1);
                    cryptolistfrom = $("#convertfromcryptolist").val(); 
                    cryptolistto = $("#converttocryptolist").val();

                    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym="+cryptolistto+"&tsyms="+cryptolistfrom+"", function(result) {
                        if (result[Object.keys(result)[0]]=='Error') {
                           alert("No Conversion Found!!!");
                        }
                        else {
                            $( "#convertfromcrypto").val(result[Object.keys(result)[0]]);
                        };
                    });
                });

                $("#convertfromcrypto").on("keyup", function(event) {
                    event.preventDefault();
                    cryptolistfrom = $("#convertfromcryptolist").val();
                    cryptolistto = $("#converttocryptolist").val();
                    amountfrom = parseFloat($("#convertfromcrypto").val())|| 1;

                    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym="+cryptolistfrom+"&tsyms="+cryptolistto+"", function(result) {
                        if (result[Object.keys(result)[0]]=='Error') {
                           alert("No Conversion Found!!!");
                        }
                        else {
                            $( "#converttocrypto").val(result[Object.keys(result)[0]]*amountfrom);
                        };
                    });

                });

                $("#converttocrypto").on("keyup", function(event) {
                    event.preventDefault();
                    cryptolistfrom = $("#convertfromcryptolist").val();
                    cryptolistto = $("#converttocryptolist").val();
                    amountto = parseFloat($("#converttocrypto").val())|| 1;

                    $.getJSON("https://min-api.cryptocompare.com/data/price?fsym="+cryptolistto+"&tsyms="+cryptolistfrom+"", function(result) {
                        if (result[Object.keys(result)[0]]=='Error') {
                           alert("No Conversion Found!!!");
                        }
                        else {
                            $("#convertfromcrypto").val(result[Object.keys(result)[0]]*amountto);
                        };
                    });

                });               

            });
        </script>
        
        <script>
            $(function () {
                $('.selectpicker').selectpicker();
            });
        </script>
        
        <!-- Ajax Language Change -->
        <script type="text/javascript">
            $(function(){
                $(".lang-change").on("change", function(event) {
                    event.preventDefault();

                    var langh = $("#lang-changeH").val();
                    var langf = $("#lang-changeF").val();

                    var lang = langf;
                    var token   = "<?php echo $this->security->get_csrf_hash(); ?>";
                    var inputdata = "lang="+lang+"&<?php echo $this->security->get_csrf_token_name(); ?>="+token;
                    $.ajax({
                        url: "<?php echo base_url('home/langChange'); ?>",
                        type: "post",
                        data: inputdata,
                        success: function(result,status,xhr) {
                            location.reload();
                        },
                        error: function(xhr,status,error){
                            location.reload();
                        }
                    });
                });
            });
        </script>
        <!-- Ajax Subscription -->
        <script type="text/javascript">
            function isValidEmailAddress(emailAddress) {
                var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return pattern.test(emailAddress);
            }

            $(function(){
                $("#subscribeForm").on("submit", function(event) {
                    event.preventDefault();
                    var inputdata = $("#subscribeForm").serialize();
                    var email = $('input[name=subscribe_email]').val();

                    if (email == "") {
                        alert("Please Input Your Email !!!");
                        return false;
                    }
                    if (!isValidEmailAddress(email)) {
                        alert("Please Enter Valid Email !!!");
                        return false;
                    }

                    $.ajax({
                        url: "<?php echo base_url('home/subscribe'); ?>",
                        type: "post",
                        data: inputdata,
                        success: function(result,status,xhr) {
                            alert("Subscribtion complete");
                            location.reload();
                        },
                        error: function (xhr,status,error) {
                            if (xhr.status===500) {
                                alert("This Email Address already subscribed");
                            }
                        }
                    });
                });
            }); 
        </script>
        
<?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='home' || $this->uri->segment(1)=='news') { ?>
        <!-- News Tricker -->
        <script type="text/javascript">
            $(function(){
               window.setTimeout(function(){
                    $( ".list-item-currency span").text("Loading...");
                    $.ajax({
                            url: "<?php echo base_url('home/cointrickerdata/') ?>",
                            type: "GET",
                            dataType : "json",
                            success: function(result,status,xhr) {

                                var keys = Object.keys(result);
                                for(var i=0;i<keys.length;i++){
                                    var key = keys[i];
                                    $( "#"+key+" .list-item-currency").text(key+"USD");
                                    $( "#"+key+" .upgrade").html("<span>"+result[key]+"</span>");
                                }

                            },
                            error: function(xhr,status,error){

                            }
                        });
                }, 100);

            });                    
        </script>

<?php } ?>

<?php if ($this->uri->segment(1)=='register' || $this->uri->segment(1)=='login' || $this->uri->segment(2)=='register' || $this->uri->segment(2)=='login') { ?>
        <script type="text/javascript">
            var url = window.location.href;
            var tab = url.substring(url.lastIndexOf('#') + 1);
            var logintab = url.substring(url.lastIndexOf('login'));

            if (tab == 'tab2') {
              $("#btntab2").addClass("active");
              $("#tab2").addClass("in active");
              $("#btntab1").removeClass("active");
              $("#tab1").removeClass("in active");
            }
            if (logintab == 'login') {
              $("#btntab2").addClass("active");
              $("#tab2").addClass("in active");
              $("#btntab1").removeClass("active");
              $("#tab1").removeClass("in active");
            }
        </script>
        <script>
            (function () {
                // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
                if (!String.prototype.trim) {
                    (function () {
                        // Make sure we trim BOM and NBSP
                        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                        String.prototype.trim = function () {
                            return this.replace(rtrim, '');
                        };
                    })();
                }

                [].slice.call(document.querySelectorAll('input.input__field')).forEach(function (inputEl) {
                    // in case the input is already filled..
                    if (inputEl.value.trim() !== '') {
                        classie.add(inputEl.parentNode, 'input--filled');
                    }

                    // events:
                    inputEl.addEventListener('focus', onInputFocus);
                    inputEl.addEventListener('blur', onInputBlur);
                });

                function onInputFocus(ev) {
                    classie.add(ev.target.parentNode, 'input--filled');
                }

                function onInputBlur(ev) {
                    if (ev.target.value.trim() === '') {
                        classie.remove(ev.target.parentNode, 'input--filled');
                    }
                }
            })();
        </script>
        <!-- Select Mobile -->
        <script type="text/javascript">
            $(function(){
                $("#country").on("change", function(event) {
                    event.preventDefault();
                    $( "#phone").val(this.value);
                });
            });
        </script>
<?php } ?>
<?php if ($this->uri->segment(1)=='contact') { ?>
        <script>
            // When the window has finished loading create our google map below
            //google.maps.event.addDomListener(window, 'load', initMap);

            function initMap() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(<?php echo $settings->latitude ?>), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"stylers": [{"hue": "#007fff"}, {"saturation": 89}]}, {"featureType": "water", "stylers": [{"color": "#ffffff"}]}, {"featureType": "administrative.country", "elementType": "labels", "stylers": [{"visibility": "off"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');
                // AIzaSyAUmj7I0GuGJWRcol-pMUmM4rrnHS90DE8
                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo $settings->latitude ?>),
                    map: map,
                    title: 'Snazzy!'
                });
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUmj7I0GuGJWRcol-pMUmM4rrnHS90DE8&callback=initMap" type="text/javascript"></script>
        <!-- Ajax Contract From -->
        <script type="text/javascript">
            $(function(){
                $("#contactForm").on("submit", function(event) {
                    event.preventDefault();
                    var inputdata = $("#contactForm").serialize();
                    $.ajax({
                        url: "<?php echo base_url('home/contactMsg'); ?>",
                        type: "post",
                        data: inputdata,
                        success: function(d) {
                            alert("Message send successfuly");
                            location.reload();
                        },
                        error: function(){
                            alert("Message send Fail");
                        }
                    });
                });
            }); 
        </script>
<?php } ?>

<?php if ($this->uri->segment(1)=='buy') { 

$gateway = $this->db->select('*')->from('payment_gateway')->where('id',4)->where('status',1)->get()->row();
?>
        <!-- Ajax Buy Crypto -->
        <script type="text/javascript">
            $(function(){ 
                $("#cid").on("change", function(event) {
                    event.preventDefault();
                    var cid = $("#cid").val()|| 0;

                    var inputdata = 'cid='+cid+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                    $.ajax({
                        url: "<?php echo base_url('home/buypayable'); ?>",
                        type: "post",
                        data: inputdata,
                        success: function(data) {
                            $( ".buy_payable").html(data);
                            $( "#buy_amount" ).prop( "disabled", false );
                        },
                        error: function(){

                        }
                    });
                });

                $("#buy_amount").on("keyup", function(event) {
                    event.preventDefault();
                    var buy_amount = parseFloat($("#buy_amount").val())|| 0;
                    var cid = $("#cid").val()|| 0;
                    if (cid=="") {
                        alert("<?php echo display("please_select_cryptocurrency_first") ?>");
                        return false;
                    } else {
                        var inputdata = "cid="+cid+"&amount="+buy_amount+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                         $.ajax({
                            url: "<?php echo base_url('home/buypayable'); ?>",
                            type: "post",
                            data: inputdata,
                            success: function(data) {
                                $( ".buy_payable").html(data);
                            },
                            error: function(){
                                return false;
                            }
                        });
                    }
                });

                $("#payment_method").on("change", function(event) {
                    event.preventDefault();
                    var payment_method = $("#payment_method").val()|| 0;
                    var cid = $("#cid").val()|| 0;

                    if (payment_method==='bitcoin' && cid==1) {
                        alert("<?php echo display("please_select_diffrent_payment_method") ?>");
                        $('#payment_method option:selected').removeAttr('selected');
                        return false;
                    }
                    
                    if (payment_method==='phone') {
                        $(".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 control-label'><?php echo display("send_money") ?></label><div class='col-sm-8'><h2><a href='tel:<?=@$gateway->public_key?>'><?=@$gateway->public_key?></a></h2></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("om_name") ?></label><div class='col-sm-8'><input name='om_name' class='form-control input-solid om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("om_mobile_no") ?></label><div class='col-sm-8'><input name='om_mobile' class='form-control input-solid om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("transaction_no") ?></label><div class='col-sm-8'><input name='transaction_no' class='form-control input-solid transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("idcard_no") ?></label><div class='col-sm-8'><input name='idcard_no' class='form-control input-solid idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");
                    }
                    else{
                        $(".payment_info").html("<div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("comments") ?></label><div class='col-sm-8'><textarea name='comments' class='form-control input-solid' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
                    }
                });

            }); 
        </script>
<?php } ?>
<?php if ($this->uri->segment(1)=='sells' || $this->uri->segment(1)=='sell')  { 
    
$gateway = $this->db->select('*')->from('payment_gateway')->where('id',4)->where('status',1)->get()->row();
?>
        <!-- Ajax Sell -->
        <script type="text/javascript">
            $(function(){
                $("#cid").on("change", function(event) {
                    event.preventDefault();
                    var cid = $("#cid").val()|| 0;

                    var inputdata = 'cid='+cid+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                    $.ajax({
                        url: "<?php echo base_url('home/sellpayable'); ?>",
                        type: "post",
                        data: inputdata,
                        success: function(data) {
                            $( ".sell_payable").html(data);
                            $( "#sell_amount" ).prop( "disabled", false );
                        },
                        error: function(x){
                            return false;
                        }
                    });
                });

                $("#sell_amount").on("keyup", function(event) {
                    event.preventDefault();
                    var sell_amount = parseFloat($("#sell_amount").val())|| 0;
                    var cid = $("#cid").val()|| 0;
                    if (cid=="") {
                        alert("<?php echo display("please_select_cryptocurrency_first") ?>");
                        return false;
                    } else {
                        var inputdata = "cid="+cid+"&amount="+sell_amount+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";

                         $.ajax({
                            url: "<?php echo base_url('home/sellpayable'); ?>",
                            type: "post",
                            data: inputdata,
                            success: function(data) {
                                $( ".sell_payable").html(data);
                            },
                            error: function(){
                                return false;
                            }
                        });
                    }
                });

                $("#payment_method").on("change", function(event) {
                    event.preventDefault();
                    var payment_method = $("#payment_method").val()|| 0;

                    if (payment_method==='bitcoin') {
                        $(".payment_info").html("<div class='form-group row'><label class='col-sm-4 control-label comments_level'><?php echo display("bitcoin_wallet_id") ?></label><div class='col-sm-8'><textarea name='comments' class='form-control input-solid input-solid input-solid' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
                    }else if(payment_method==='payeer'){
                       $(".payment_info").html("<div class='form-group row'><label class='col-sm-4 control-label comments_level'><?php echo display("payeer_wallet_id") ?></label><div class='col-sm-8'><textarea name='comments' class='form-control input-solid input-solid input-solid' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
                    }else if(payment_method==='phone'){
                        $(".payment_info").html("<div class='form-group row'><label for='send_money' class='col-sm-4 control-label'><?php echo display("send_money") ?></label><div class='col-sm-8'><h2><a href='tel:<?=@$gateway->public_key?>'><?=@$gateway->public_key?></a></h2></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("om_name") ?></label><div class='col-sm-8'><input name='om_name' class='form-control input-solid input-solid om_name' type='text' id='om_name' autocomplete='off'></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("om_mobile_no") ?></label><div class='col-sm-8'><input name='om_mobile' class='form-control input-solid input-solid om_mobile' type='text' id='om_mobile' autocomplete='off'></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("transaction_no") ?></label><div class='col-sm-8'><input name='transaction_no' class='form-control input-solid input-solid transaction_no' type='text' id='transaction_no' autocomplete='off'></div></div><div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("idcard_no") ?></label><div class='col-sm-8'><input name='idcard_no' class='form-control input-solid input-solid idcard_no' type='text' id='idcard_no' autocomplete='off'></div></div>");
                    }
                    else{
                        $(".payment_info").html("<div class='form-group row'><label class='col-sm-4 control-label'><?php echo display("comments") ?></label><div class='col-sm-8'><textarea name='comments' class='form-control input-solid' placeholder='' type='text' id='comments' autocomplete='off'></textarea></div></div>");
                    }
                });

            }); 
        </script>
<?php } ?>

    </body>
</html>