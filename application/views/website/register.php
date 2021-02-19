<?php 
    $i=1; 
    foreach ($article as $key => $value) { 
        $article_image[] = $value->article_image;

        $i++;
    } 

 ?>

<?php
$countryArray = array(
    'AD'=>array('name'=>'ANDORRA','code'=>'376'),
    'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),
    'AF'=>array('name'=>'AFGHANISTAN','code'=>'93'),
    'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),
    'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),
    'AL'=>array('name'=>'ALBANIA','code'=>'355'),
    'AM'=>array('name'=>'ARMENIA','code'=>'374'),
    'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),
    'AO'=>array('name'=>'ANGOLA','code'=>'244'),
    'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),
    'AR'=>array('name'=>'ARGENTINA','code'=>'54'),
    'AS'=>array('name'=>'AMERICAN SAMOA','code'=>'1684'),
    'AT'=>array('name'=>'AUSTRIA','code'=>'43'),
    'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),
    'AW'=>array('name'=>'ARUBA','code'=>'297'),
    'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),
    'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),
    'BB'=>array('name'=>'BARBADOS','code'=>'1246'),
    'BD'=>array('name'=>'BANGLADESH','code'=>'880'),
    'BE'=>array('name'=>'BELGIUM','code'=>'32'),
    'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),
    'BG'=>array('name'=>'BULGARIA','code'=>'359'),
    'BH'=>array('name'=>'BAHRAIN','code'=>'973'),
    'BI'=>array('name'=>'BURUNDI','code'=>'257'),
    'BJ'=>array('name'=>'BENIN','code'=>'229'),
    'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),
    'BM'=>array('name'=>'BERMUDA','code'=>'1441'),
    'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),
    'BO'=>array('name'=>'BOLIVIA','code'=>'591'),
    'BR'=>array('name'=>'BRAZIL','code'=>'55'),
    'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),
    'BT'=>array('name'=>'BHUTAN','code'=>'975'),
    'BW'=>array('name'=>'BOTSWANA','code'=>'267'),
    'BY'=>array('name'=>'BELARUS','code'=>'375'),
    'BZ'=>array('name'=>'BELIZE','code'=>'501'),
    'CA'=>array('name'=>'CANADA','code'=>'1'),
    'CC'=>array('name'=>'COCOS (KEELING) ISLANDS','code'=>'61'),
    'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),
    'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),
    'CG'=>array('name'=>'CONGO','code'=>'242'),
    'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),
    'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),
    'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),
    'CL'=>array('name'=>'CHILE','code'=>'56'),
    'CM'=>array('name'=>'CAMEROON','code'=>'237'),
    'CN'=>array('name'=>'CHINA','code'=>'86'),
    'CO'=>array('name'=>'COLOMBIA','code'=>'57'),
    'CR'=>array('name'=>'COSTA RICA','code'=>'506'),
    'CU'=>array('name'=>'CUBA','code'=>'53'),
    'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),
    'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),
    'CY'=>array('name'=>'CYPRUS','code'=>'357'),
    'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),
    'DE'=>array('name'=>'GERMANY','code'=>'49'),
    'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),
    'DK'=>array('name'=>'DENMARK','code'=>'45'),
    'DM'=>array('name'=>'DOMINICA','code'=>'1767'),
    'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),
    'DZ'=>array('name'=>'ALGERIA','code'=>'213'),
    'EC'=>array('name'=>'ECUADOR','code'=>'593'),
    'EE'=>array('name'=>'ESTONIA','code'=>'372'),
    'EG'=>array('name'=>'EGYPT','code'=>'20'),
    'ER'=>array('name'=>'ERITREA','code'=>'291'),
    'ES'=>array('name'=>'SPAIN','code'=>'34'),
    'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),
    'FI'=>array('name'=>'FINLAND','code'=>'358'),
    'FJ'=>array('name'=>'FIJI','code'=>'679'),
    'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),
    'FM'=>array('name'=>'MICRONESIA, FEDERATED STATES OF','code'=>'691'),
    'FO'=>array('name'=>'FAROE ISLANDS','code'=>'298'),
    'FR'=>array('name'=>'FRANCE','code'=>'33'),
    'GA'=>array('name'=>'GABON','code'=>'241'),
    'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),
    'GD'=>array('name'=>'GRENADA','code'=>'1473'),
    'GE'=>array('name'=>'GEORGIA','code'=>'995'),
    'GH'=>array('name'=>'GHANA','code'=>'233'),
    'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),
    'GL'=>array('name'=>'GREENLAND','code'=>'299'),
    'GM'=>array('name'=>'GAMBIA','code'=>'220'),
    'GN'=>array('name'=>'GUINEA','code'=>'224'),
    'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),
    'GR'=>array('name'=>'GREECE','code'=>'30'),
    'GT'=>array('name'=>'GUATEMALA','code'=>'502'),
    'GU'=>array('name'=>'GUAM','code'=>'1671'),
    'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),
    'GY'=>array('name'=>'GUYANA','code'=>'592'),
    'HK'=>array('name'=>'HONG KONG','code'=>'852'),
    'HN'=>array('name'=>'HONDURAS','code'=>'504'),
    'HR'=>array('name'=>'CROATIA','code'=>'385'),
    'HT'=>array('name'=>'HAITI','code'=>'509'),
    'HU'=>array('name'=>'HUNGARY','code'=>'36'),
    'ID'=>array('name'=>'INDONESIA','code'=>'62'),
    'IE'=>array('name'=>'IRELAND','code'=>'353'),
    'IL'=>array('name'=>'ISRAEL','code'=>'972'),
    'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),
    'IN'=>array('name'=>'INDIA','code'=>'91'),
    'IQ'=>array('name'=>'IRAQ','code'=>'964'),
    'IR'=>array('name'=>'IRAN, ISLAMIC REPUBLIC OF','code'=>'98'),
    'IS'=>array('name'=>'ICELAND','code'=>'354'),
    'IT'=>array('name'=>'ITALY','code'=>'39'),
    'JM'=>array('name'=>'JAMAICA','code'=>'1876'),
    'JO'=>array('name'=>'JORDAN','code'=>'962'),
    'JP'=>array('name'=>'JAPAN','code'=>'81'),
    'KE'=>array('name'=>'KENYA','code'=>'254'),
    'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),
    'KH'=>array('name'=>'CAMBODIA','code'=>'855'),
    'KI'=>array('name'=>'KIRIBATI','code'=>'686'),
    'KM'=>array('name'=>'COMOROS','code'=>'269'),
    'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),
    'KP'=>array('name'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF','code'=>'850'),
    'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),
    'KW'=>array('name'=>'KUWAIT','code'=>'965'),
    'KY'=>array('name'=>'CAYMAN ISLANDS','code'=>'1345'),
    'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),
    'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),
    'LB'=>array('name'=>'LEBANON','code'=>'961'),
    'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),
    'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),
    'LK'=>array('name'=>'SRI LANKA','code'=>'94'),
    'LR'=>array('name'=>'LIBERIA','code'=>'231'),
    'LS'=>array('name'=>'LESOTHO','code'=>'266'),
    'LT'=>array('name'=>'LITHUANIA','code'=>'370'),
    'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),
    'LV'=>array('name'=>'LATVIA','code'=>'371'),
    'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),
    'MA'=>array('name'=>'MOROCCO','code'=>'212'),
    'MC'=>array('name'=>'MONACO','code'=>'377'),
    'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),
    'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),
    'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),
    'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),
    'MH'=>array('name'=>'MARSHALL ISLANDS','code'=>'692'),
    'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),
    'ML'=>array('name'=>'MALI','code'=>'223'),
    'MM'=>array('name'=>'MYANMAR','code'=>'95'),
    'MN'=>array('name'=>'MONGOLIA','code'=>'976'),
    'MO'=>array('name'=>'MACAU','code'=>'853'),
    'MP'=>array('name'=>'NORTHERN MARIANA ISLANDS','code'=>'1670'),
    'MR'=>array('name'=>'MAURITANIA','code'=>'222'),
    'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),
    'MT'=>array('name'=>'MALTA','code'=>'356'),
    'MU'=>array('name'=>'MAURITIUS','code'=>'230'),
    'MV'=>array('name'=>'MALDIVES','code'=>'960'),
    'MW'=>array('name'=>'MALAWI','code'=>'265'),
    'MX'=>array('name'=>'MEXICO','code'=>'52'),
    'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
    'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),
    'NA'=>array('name'=>'NAMIBIA','code'=>'264'),
    'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),
    'NE'=>array('name'=>'NIGER','code'=>'227'),
    'NG'=>array('name'=>'NIGERIA','code'=>'234'),
    'NI'=>array('name'=>'NICARAGUA','code'=>'505'),
    'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),
    'NO'=>array('name'=>'NORWAY','code'=>'47'),
    'NP'=>array('name'=>'NEPAL','code'=>'977'),
    'NR'=>array('name'=>'NAURU','code'=>'674'),
    'NU'=>array('name'=>'NIUE','code'=>'683'),
    'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),
    'OM'=>array('name'=>'OMAN','code'=>'968'),
    'PA'=>array('name'=>'PANAMA','code'=>'507'),
    'PE'=>array('name'=>'PERU','code'=>'51'),
    'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),
    'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),
    'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),
    'PK'=>array('name'=>'PAKISTAN','code'=>'92'),
    'PL'=>array('name'=>'POLAND','code'=>'48'),
    'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),
    'PN'=>array('name'=>'PITCAIRN','code'=>'870'),
    'PR'=>array('name'=>'PUERTO RICO','code'=>'1'),
    'PT'=>array('name'=>'PORTUGAL','code'=>'351'),
    'PW'=>array('name'=>'PALAU','code'=>'680'),
    'PY'=>array('name'=>'PARAGUAY','code'=>'595'),
    'QA'=>array('name'=>'QATAR','code'=>'974'),
    'RO'=>array('name'=>'ROMANIA','code'=>'40'),
    'RS'=>array('name'=>'SERBIA','code'=>'381'),
    'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),
    'RW'=>array('name'=>'RWANDA','code'=>'250'),
    'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),
    'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),
    'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),
    'SD'=>array('name'=>'SUDAN','code'=>'249'),
    'SE'=>array('name'=>'SWEDEN','code'=>'46'),
    'SG'=>array('name'=>'SINGAPORE','code'=>'65'),
    'SH'=>array('name'=>'SAINT HELENA','code'=>'290'),
    'SI'=>array('name'=>'SLOVENIA','code'=>'386'),
    'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),
    'SL'=>array('name'=>'SIERRA LEONE','code'=>'232'),
    'SM'=>array('name'=>'SAN MARINO','code'=>'378'),
    'SN'=>array('name'=>'SENEGAL','code'=>'221'),
    'SO'=>array('name'=>'SOMALIA','code'=>'252'),
    'SR'=>array('name'=>'SURINAME','code'=>'597'),
    'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),
    'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),
    'SY'=>array('name'=>'SYRIAN ARAB REPUBLIC','code'=>'963'),
    'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),
    'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),
    'TD'=>array('name'=>'CHAD','code'=>'235'),
    'TG'=>array('name'=>'TOGO','code'=>'228'),
    'TH'=>array('name'=>'THAILAND','code'=>'66'),
    'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),
    'TK'=>array('name'=>'TOKELAU','code'=>'690'),
    'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),
    'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),
    'TN'=>array('name'=>'TUNISIA','code'=>'216'),
    'TO'=>array('name'=>'TONGA','code'=>'676'),
    'TR'=>array('name'=>'TURKEY','code'=>'90'),
    'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),
    'TV'=>array('name'=>'TUVALU','code'=>'688'),
    'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),
    'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),
    'UA'=>array('name'=>'UKRAINE','code'=>'380'),
    'UG'=>array('name'=>'UGANDA','code'=>'256'),
    'US'=>array('name'=>'UNITED STATES','code'=>'1'),
    'UY'=>array('name'=>'URUGUAY','code'=>'598'),
    'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),
    'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),
    'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),
    'VE'=>array('name'=>'VENEZUELA','code'=>'58'),
    'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),
    'VI'=>array('name'=>'VIRGIN ISLANDS, U.S.','code'=>'1340'),
    'VN'=>array('name'=>'VIET NAM','code'=>'84'),
    'VU'=>array('name'=>'VANUATU','code'=>'678'),
    'WF'=>array('name'=>'WALLIS AND FUTUNA','code'=>'681'),
    'WS'=>array('name'=>'SAMOA','code'=>'685'),
    'XK'=>array('name'=>'KOSOVO','code'=>'381'),
    'YE'=>array('name'=>'YEMEN','code'=>'967'),
    'YT'=>array('name'=>'MAYOTTE','code'=>'262'),
    'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),
    'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),
    'ZW'=>array('name'=>'ZIMBABWE','code'=>'263')
);

?>
        <div class="reg-wrapper">
            <div class="container">
                <div class="col-sm-7 col-md-6">
                    <div class="">
                        <ul class="nav nav-tabs">
                            <li id="btntab1" class="active"><a href="#tab1" data-toggle="tab">Register</a></li>
                            <li id="btntab2"><a href="#tab2" data-toggle="tab">Log in</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="row">
                                <!-- alert message -->
                                <?php if ($this->session->flashdata('message') != null) {  ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div> 
                                <?php } ?>
                                    
                                <?php if ($this->session->flashdata('exception') != null) {  ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $this->session->flashdata('exception'); ?>
                                </div>
                                <?php } ?>
                                    
                                <?php if (validation_errors()) {  ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php } ?> 
                            </div>
                            <div class="tab-pane fade in active" id="tab1">
                                <?php echo form_open('register','id="registerForm" name="registerForm" onsubmit="return validateForm()" '); ?>
                                <div class="row">    
                                    <div class="col-sm-6">
                                        <div class="input">
                                            <input class="input__field" type="text"  name="f_name" id="f_name" value="<?php echo $this->session->userData['f_name']; ?>" autocomplete="off" required>
                                            <label class="input__label" for="f_name">
                                                <span class="input__label-content" data-content="<?php echo display('firstname'); ?>"><?php echo display('firstname'); ?></span>
                                            </label>
                                        </div>
                                    </div>    
                                    <div class="col-sm-6">
                                        <div class="input">
                                            <input class="input__field" type="text"  name="l_name" id="l_name" value="<?php echo $this->session->userData['l_name']; ?>" autocomplete="off" required>
                                            <label class="input__label" for="l_name">
                                                <span class="input__label-content" data-content="<?php echo display('lastname'); ?>"><?php echo display('lastname'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <input class="input__field" type="text" name="username" id="username" required>
                                            <label class="input__label" for="username">
                                                <span class="input__label-content" data-content="<?php echo display('username'); ?>"><?php echo display('username'); ?></span>
                                            </label>
                                        </div>
                                    </div>    
                                    <?php

                                        $this->load->helper(array('cookie', 'url'));
                                        $ref=$this->input->get('ref'); 
                                        if (isset($ref) && ($ref!="")) {
                                            $user_id = $this->db->select('user_id')->where('user_id', $ref)->get('user_registration')->row();
                                            if($user_id){
                                                set_cookie('sponsor_id', $ref, 86400*30);
                                                //echo $ref;
                                            } else{
                                                //echo "Invalid Sponsor";
                                            }
                                        }
                                        else{
                                            if (!get_cookie('sponsor_id')) {
                                                $user_id = $this->db->select('user_id')->where('sponsor_id', 0)->get('user_registration')->row();
                                                set_cookie('sponsor_id', $user_id->user_id, 86400*30);
                                            }
                                            
                                            //echo get_cookie('sponsor_id');
                                        }

                                    ?>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-6">
                                        <div class="input">
                                            <select  class="selectpicker" data-width="100%" class="country input__field" id="country" name="country">
                                                <option value="" selected>Select Country</option>
                                                <?php
                                                    foreach($countryArray as $code => $country){
                                                        $countryName = ucwords(strtolower($country["name"]));
                                                ?>
                                                <option value="<?=$country["code"]?>"><?=$countryName." (+".$country["code"].")"?></option>
                                                <?php } ?>
                                            </select>
                                            <label class="input__label" for="country">
                                                <span class="input__label-content" data-content="<?php echo display('country'); ?>"><?php echo display('country'); ?></span>
                                            </label>
                                        </div>
                                    </div>    
                                    <div class="col-sm-6">
                                        <div class="input">
                                            <input class="input__field" type="number" name="phone" id="phone" autocomplete="off" required>
                                            <label class="input__label" for="phone">
                                                <span class="input__label-content" data-content="<?php echo display('phone'); ?>"><?php echo display('phone'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <input class="input__field" type="email" id="email" name="email" id="email" onkeydown="checkEmail()" value="<?php echo $this->session->userData['email']; ?>" autocomplete="off" required>
                                            <label class="input__label" for="email">
                                                <span class="input__label-content" data-content="<?php echo display('email'); ?>"><?php echo display('email'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <input class="input__field" type="password" name="pass" id="pass" onkeyup="strongPassword()" required>
                                            <label class="input__label" for="pass">
                                                <span class="input__label-content" data-content="<?php echo display('password'); ?>"><?php echo display('password'); ?></span>
                                            </label>
                                            <div id="message">
                                              <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                              <p id="special" class="invalid">A <b>special</b></p>
                                              <p id="number" class="invalid">A <b>number</b></p>
                                              <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <input class="input__field" type="password" name="r_pass" id="r_pass" onkeyup="rePassword()" required>
                                            <label class="input__label" for="r_pass">
                                                <span class="input__label-content" data-content="<?php echo display('conf_password'); ?>"><?php echo display('conf_password'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <label>
                                                <input type="checkbox" id="checkbox" name="accept_terms" value="ptConfirm"> 
                                            </label>
                                            <?php echo display('your_password_at_global_crypto_are_encrypted_and_secured'); ?> <a target="_blank" href="<?php echo base_url(@$article_image[0]); ?>" class="checkbox-link">Privacy policy</a> and 
                                                <a target="_blank" href="<?php echo base_url(@$article_image[0]); ?>" class="checkbox-link">Terms of Use</a>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-reg"><?php echo display('sign_up'); ?></button>
                                <?php echo form_close() ?>

                            </div>
                            <div class="tab-pane fade" id="tab2">
                                <?php echo form_open('home/login','id="loginForm" '); ?>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <input class="input__field" type="text" name="email" id="useremail" autocomplete="off" required>
                                            <label class="input__label" for="input">
                                                <span class="input__label-content" data-content="<?php echo display('username_or_email'); ?>"><?php echo display('username_or_email'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <input class="input__field" type="password" name="password" id="password" required>
                                            <label class="input__label" for="password">
                                                <span class="input__label-content" data-content="<?php echo display('password'); ?>"><?php echo display('password'); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <div class="input">
                                            <a href="#" data-toggle="modal" data-target="#forgotModal" class="forgot"><?php echo display('forgot_password'); ?>?</a><?php echo display('dont_have_an_account'); ?>? <a href="<?php echo base_url('register'); ?>" class="checkbox-link"><?php echo display('sign_up_now'); ?></a>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-reg"><?php echo display('login'); ?></button>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div id="forgotModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo display('forgot_password'); ?></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('home/forgotPassword','id="forgotPassword"'); ?>
            <div class="form-group">
                <input class="form-control" name="email" id="email" placeholder="<?php echo display('email'); ?>" type="text" autocomplete="off">
            </div>
            <button  type="submit" class="btn btn-success btn-block"><?php echo display('send_code'); ?></button>
        <?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close'); ?></button>
      </div>
    </div>

  </div>
</div>

        <style>
            #message {
                display:none;
                position: relative;
                padding: 20px;
                margin-top: 10px;
            }
            #message p {
                margin-bottom: 0;
            }
            .input .valid {
                color: green;
            }
            .input .valid:before {
                position: relative;
                left: -10px;
                content: "✔";
            }
            .input .invalid {
                color: red;
            }
            .input .invalid:before {
                position: relative;
                left: -10px;
                content: "✖";
            }
        </style>
        <script type="text/javascript">
            var myInput = document.getElementById("pass");
            var letter  = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var special = document.getElementById("special");
            var number  = document.getElementById("number");
            var length  = document.getElementById("length");

            myInput.onfocus = function() {
                document.getElementById("message").style.display = "block";
            }
            myInput.onblur = function() {
                document.getElementById("message").style.display = "none";
            }

            myInput.onkeyup = function() {

              var lowerCaseLetters = /[a-z]/g;
              if(myInput.value.match(lowerCaseLetters)) {  
                letter.classList.remove("invalid");
                letter.classList.add("valid");
              } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
              }

              var upperCaseLetters = /[A-Z]/g;
              if(myInput.value.match(upperCaseLetters)) {  
                capital.classList.remove("invalid");
                capital.classList.add("valid");
              } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
              }

              var specialCharacter = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
              if(myInput.value.match(specialCharacter)) {  
                special.classList.remove("invalid");
                special.classList.add("valid");
              } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
              }

              var numbers = /[0-9]/g;
              if(myInput.value.match(numbers)) {  
                number.classList.remove("invalid");
                number.classList.add("valid");
              } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
              }

              if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
              } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
              }
            }

            //Confirm Password check
            function rePassword() {
                var pass = document.getElementById("pass").value;
                var r_pass = document.getElementById("r_pass").value;

                if (pass !== r_pass) {
                    document.getElementById("r_pass").style.borderColor = '#f00';
                    return false;
                }
                else{
                    document.getElementById("r_pass").style.borderColor = 'unset';
                    return true;
                }
            }
            //Valid Email Address Check
            function checkEmail() {
                var email = document.getElementById('email');
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if (!filter.test(email.value)) {
                    document.getElementById("email").style.borderColor = '#f00';
                    return false;
                }
                else{
                    document.getElementById("email").style.borderColor = 'unset';
                    return true;
                }
            }
            //Registration From validation check
            function validateForm() {
                var f_name    = document.forms["registerForm"]["f_name"].value;
                var l_name    = document.forms["registerForm"]["l_name"].value;
                var username  = document.forms["registerForm"]["username"].value;
                // var sponsor_id= document.forms["registerForm"]["sponsor_id"].value;
                var email     = document.forms["registerForm"]["email"].value;
                var phone     = document.forms["registerForm"]["phone"].value;
                var country   = document.forms["registerForm"]["country"].value;
                var pass      = document.forms["registerForm"]["pass"].value;
                var r_pass    = document.forms["registerForm"]["r_pass"].value;
                var checkbox  = document.forms["registerForm"]["accept_terms"].value;

                if (f_name == "") {
                    alert("First Name Required");
                    return false;
                }
                if (l_name == "") {
                    alert("Last Name Required");
                    return false;
                }
                if (username == "") {
                    alert("User Name Required");
                    return false;
                }
                if (country == "") {
                    alert("Country Required");
                    return false;
                }
                if (phone == "") {
                    alert("Phone Required");
                    return false;
                }
                if (email == "") {
                    alert("Email Required");
                    return false;
                }
                if (pass == "") {
                    alert("Password Required.");
                    return false;
                }
                if (pass.length < 8) {
                    alert("Please Enter at least 8 Characters input");
                    return false;
                }
                if (r_pass == "") {
                    alert("Confirm Password must be filled out");
                    return false;
                }
                if (checkbox == "") {
                    alert("Must Confirm Privacy Policy and Terms and Conditions");
                    return false;
                }
            }
        </script>