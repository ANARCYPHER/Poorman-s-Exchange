<?php
    ini_set("allow_url_fopen", 1);

    $cid =$this->uri->segment(2);

    if ($cid=='') { $cid='1182'; }

    $test2 = file_get_contents('https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$cid);
    $history2 = json_decode($test2, true);

    foreach (@$history2['Data']['General'] as $gen_key => $gen_value) {

        $general[$gen_key] = $gen_value;

    // $general['Id'];
    // $general['DocumentType'];
    // $general['H1Text'];
    // $general['DangerTop'];
    // $general['WarningTop'];
    // $general['InfoTop'];
    // $general['Symbol'];
    // $general['Url'];
    // $general['BaseAngularUrl'];
    // $general['Name'];
    // $general['ImageUrl'];
    // $general['Description'];
    // $general['Features'];
    // $general['Technology'];
    // $general['TotalCoinSupply'];
    // $general['DifficultyAdjustment'];
    // $general['BlockRewardReduction'];
    // $general['Algorithm'];
    // $general['ProofType'];
    // $general['StartDate'];
    // $general['Twitter'];
    // $general['WebsiteUrl'];
    // $general['Website'];
    // $general['Sponsor'];
    // $general['IndividualSponsor'];
    // $general['LastBlockExplorerUpdateTS'];
    // $general['BlockNumber'];
    // $general['BlockTime'];
    // $general['NetHashesPerSecond'];
    // $general['TotalCoinsMined'];
    // $general['PreviousTotalCoinsMined'];
    // $general['BlockReward'];

    }

    $imgpath = "";
    if (!empty($general['ImageUrl'])) {
        $imginfo = pathinfo("https://www.cryptocompare.com".$general['ImageUrl']);
        $imgpath = "./upload/coinlist/".$imginfo['basename'];
    }


    $test4 = file_get_contents('https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$general['Symbol'].'&tsyms=USD');
    $history4 = json_decode($test4, true);

    foreach (@$history4['DISPLAY'] as $dis_key => $dis_value) { 

    //$dis_value['USD']['frenchOMSYMBOL'];
    //$dis_value['USD']['TOSYMBOL'];
    //$dis_value['USD']['MARKET'];
    //$dis_value['USD']['PRICE']; 
    //$dis_value['USD']['LASTUPDATE'];
    //$dis_value['USD']['LASTVOLUME'];
    //$dis_value['USD']['LASTVOLUMETO'];
    //$dis_value['USD']['LASTTRADEID'];
    //$dis_value['USD']['VOLUMEDAY'];
    //$dis_value['USD']['VOLUMEDAYTO'];
    //$dis_value['USD']['VOLUME24HOUR'];
    //$dis_value['USD']['VOLUME24HOURTO'];
    //$dis_value['USD']['OPENDAY'];
    //$dis_value['USD']['HIGHDAY'];
    //$dis_value['USD']['LOWDAY'];
    //$dis_value['USD']['OPEN24HOUR'];
    //$dis_value['USD']['HIGH24HOUR'];
    //$dis_value['USD']['LOW24HOUR'];
    //$dis_value['USD']['LASTMARKET'];
    //$dis_value['USD']['CHANGE24HOUR'];
    //$dis_value['USD']['CHANGEPCT24HOUR'];
    //$dis_value['USD']['CHANGEDAY'];
    //$dis_value['USD']['CHANGEPCTDAY'];
    //$dis_value['USD']['SUPPLY'];
    //$dis_value['USD']['MKTCAP'];
    //$dis_value['USD']['TOTALVOLUME24H'];
    //$dis_value['USD']['TOTALVOLUME24HTO'];

    }
?>

        <div class="page_header" data-parallax-bg-image="<?php echo base_url($cat_info->cat_image); ?>" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <div class="company-icon">
                                    <img src="<?php echo base_url($imgpath); ?>" alt="<?php echo strip_tags($general['Name']) ?>" width="56">
                                </div>
                                <div class="company"><?php echo $general['Name']." (".$general['Symbol'].")" ?></div>
                                <div class="company-valu">
                                    <div class="company-value-title">Current Price</div>
                                    <div class="company-value-current">
                                        <?php echo $dis_value['USD']['PRICE']; ?>, 
                                        <span class="<?php echo $dis_value['USD']['CHANGEPCTDAY']<0?'percent_negative':'company-value-change' ?>"><?php echo $dis_value['USD']['CHANGEPCTDAY']; ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-bg-intro"><img src="<?php echo base_url('assets/website/'); ?>img/mask.png" class="intro-round" alt=""></div>
        </div>
        <!--  /.End of page header -->
        <div class="crypto-details">
            <div class="container">
                <div class="crypto-details-info">
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Hour Change
                        </div>
                        <div class="info-cell-value">
                            <span class="<?php echo $dis_value['USD']['CHANGEPCT24HOUR']<0?'percent_negative':'percent_positive' ?>"><?php echo $dis_value['USD']['CHANGEPCT24HOUR'] ?>%</span>
                        </div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Day Change
                        </div>
                        <div class="info-cell-value">
                            <span class="<?php echo $dis_value['USD']['CHANGEPCTDAY']<0?'percent_negative':'percent_positive' ?>"><?php echo $dis_value['USD']['CHANGEPCTDAY'] ?>%</span>
                        </div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Hour Change
                        </div>
                        <div class="info-cell-value">
                            <span class="<?php echo substr($dis_value['USD']['CHANGE24HOUR'], '1')<0?'percent_negative':'percent_positive' ?>"><?php echo $dis_value['USD']['CHANGE24HOUR']; ?></span>
                        </div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Day Change
                        </div>
                        <div class="info-cell-value">
                            <span class="<?php echo substr($dis_value['USD']['CHANGEDAY'], '1')<0?'percent_negative':'percent_positive' ?>"><?php echo $dis_value['USD']['CHANGEDAY']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="crypto-details-info">
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Market Cap
                        </div>
                        <div class="info-cell-value">
                            <span><?php echo $dis_value['USD']['MKTCAP']; ?></span>
                        </div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Volume (24h)
                        </div>
                        <div class="info-cell-value">
                            <span><?php echo $dis_value['USD']['TOTALVOLUME24H'] ?></span>
                        </div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-title">
                            Volumeto (24h)
                        </div>
                        <div class="info-cell-value">
                            <span><?php echo $dis_value['USD']['TOTALVOLUME24HTO']; ?></span>
                        </div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell-title">
                            SUPPLY
                        </div>
                        <div class="info-cell-value">
                            <span><?php echo $dis_value['USD']['SUPPLY']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="moreof">
                    <?php echo $general['Description']; ?>
                    <br>
                    <br>
                    <?php echo $general['Features']; ?>
                    <br>
                    <br>
                    <?php echo $general['Technology']; ?>
                </div>
            </div>
        </div>
        <div class="pricing-new">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <?php
                            foreach ($advertisement as $add_key => $add_value) { 
                                $ad_position   = $add_value->serial_position;
                                $ad_link       = $add_value->url;
                                $ad_script     = $add_value->script;
                                $ad_image      = $add_value->image;
                                $ad_name      = $add_value->name;
                        ?>

                        <?php if (@$ad_position==3) { ?>
                            <div class="widget_banner">
                                <?php if ($ad_script=="") { ?>
                                <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                                <?php } else { echo $ad_script; } ?>
                            </div><!-- /.End of banner -->
                        <?php } } ?>

                        <div class="price-chart">
                            <div id="chartdiv"></div>   
                        </div>
                        <!-- /.End of chart -->

        <script src="<?php echo base_url('assets/website'); ?>/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/website'); ?>/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/website'); ?>/amcharts/amstock.js" type="text/javascript"></script>
    <script>
      AmCharts.ready(function () {
        generateChartData();
        createStockChart();
      });

      var chartData = [];

      function generateChartData() {
        var firstDate = new Date();
        firstDate.setHours(0, 0, 0, 0);
        firstDate.setDate(firstDate.getDate() - 1000);

        var i=0;

        //for (var i = 0; i < 10; i++) {
<?php 
$test2 = file_get_contents('https://min-api.cryptocompare.com/data/histoday?fsym='.$general['Symbol'].'&tsym=USD&limit=1000');
$history2 = json_decode($test2, true);

foreach ($history2['Data'] as $key => $value) { ?>

          var newDate = new Date(firstDate);
          console.log(newDate);

          newDate.setDate(newDate.getDate() + i);

          var open = Math.round(<?php echo $value['open'] ?>);
          var close = Math.round(<?php echo $value['close'] ?>);

          var low;
          if (open < close) {
            low = Math.round(<?php echo $value['low'] ?>);
          } else {
            low = Math.round(<?php echo $value['low'] ?>);
          }

          var high;
          if (open < close) {
            high = Math.round(<?php echo $value['high'] ?>);
          } else {
            high = Math.round(<?php echo $value['high'] ?>);
          }

          var volume = Math.round(<?php echo $value['open'] ?>);

          var value = Math.round(<?php echo $value['open'] ?> * (30));

          chartData[i] = ({
            date: newDate,
            open: open,
            close: close,
            high: high,
            low: low,
            volume: volume,
            value: value
          });
        //}
        i++;

<?php 
}
?>
      }

      function createStockChart() {
        var chart = new AmCharts.AmStockChart();


        // DATASET //////////////////////////////////////////
        var dataSet = new AmCharts.DataSet();
        dataSet.fieldMappings = [{
          fromField: "open",
          toField: "open"
        }, {
          fromField: "close",
          toField: "close"
        }, {
          fromField: "high",
          toField: "high"
        }, {
          fromField: "low",
          toField: "low"
        }, {
          fromField: "volume",
          toField: "volume"
        }, {
          fromField: "value",
          toField: "value"
        }];
        dataSet.color = "#7f8da9";
        dataSet.dataProvider = chartData;
        dataSet.title = "West Stock";
        dataSet.categoryField = "date";

        var dataSet2 = new AmCharts.DataSet();
        dataSet2.fieldMappings = [{
          fromField: "value",
          toField: "value"
        }];
        dataSet2.color = "#fac314";
        dataSet2.dataProvider = chartData;
        dataSet2.compared = true;
        dataSet2.title = "East Stock";
        dataSet2.categoryField = "date";

        chart.dataSets = [dataSet, dataSet2];

        // PANELS ///////////////////////////////////////////
        var stockPanel = new AmCharts.StockPanel();
        stockPanel.title = "Value";
        stockPanel.showCategoryAxis = false;
        stockPanel.percentHeight = 70;

        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.dashLength = 5;
        stockPanel.addValueAxis(valueAxis);

        stockPanel.categoryAxis.dashLength = 5;

        // graph of first stock panel
        var graph = new AmCharts.StockGraph();
        graph.type = "candlestick";
        graph.openField = "open";
        graph.closeField = "close";
        graph.highField = "high";
        graph.lowField = "low";
        graph.valueField = "close";
        graph.lineColor = "#7f8da9";
        graph.fillColors = "#7f8da9";
        graph.negativeLineColor = "#db4c3c";
        graph.negativeFillColors = "#db4c3c";
        graph.proCandlesticks = true;
        graph.fillAlphas = 1;
        graph.useDataSetColors = false;
        graph.comparable = true;
        graph.compareField = "value";
        graph.showBalloon = false;
        stockPanel.addStockGraph(graph);

        var stockLegend = new AmCharts.StockLegend();
        stockLegend.valueTextRegular = undefined;
        stockLegend.periodValueTextComparing = "[[percents.value.close]]";
        stockPanel.stockLegend = stockLegend;

        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.valueLineEnabled = true;
        chartCursor.valueLineAxis = valueAxis;
        stockPanel.chartCursor = chartCursor;

        var stockPanel2 = new AmCharts.StockPanel();
        stockPanel2.title = "Volume";
        stockPanel2.percentHeight = 30;
        stockPanel2.marginTop = 1;
        stockPanel2.showCategoryAxis = true;

        var valueAxis2 = new AmCharts.ValueAxis();
        valueAxis2.dashLength = 5;
        stockPanel2.addValueAxis(valueAxis2);

        stockPanel2.categoryAxis.dashLength = 5;

        var graph2 = new AmCharts.StockGraph();
        graph2.valueField = "volume";
        graph2.type = "column";
        graph2.showBalloon = false;
        graph2.fillAlphas = 1;
        stockPanel2.addStockGraph(graph2);

        var legend2 = new AmCharts.StockLegend();
        legend2.markerType = "none";
        legend2.markerSize = 0;
        legend2.labelText = "";
        legend2.periodValueTextRegular = "[[value.close]]";
        stockPanel2.stockLegend = legend2;

        var chartCursor2 = new AmCharts.ChartCursor();
        chartCursor2.valueLineEnabled = true;
        chartCursor2.valueLineAxis = valueAxis2;
        stockPanel2.chartCursor = chartCursor2;

        chart.panels = [stockPanel, stockPanel2];


        // OTHER SETTINGS ////////////////////////////////////
        var sbsettings = new AmCharts.ChartScrollbarSettings();
        sbsettings.graph = graph;
        sbsettings.graphType = "line";
        sbsettings.usePeriod = "WW";
        sbsettings.updateOnReleaseOnly = false;
        chart.chartScrollbarSettings = sbsettings;


        // PERIOD SELECTOR ///////////////////////////////////
        var periodSelector = new AmCharts.PeriodSelector();
        periodSelector.position = "top";
        periodSelector.periods = [{
          period: "DD",
          count: 10,
          label: "10 days"
        }, {
          period: "MM",          
          count: 1,
          label: "1 month"
        }, {
          period: "YYYY",
          selected: true,
          count: 1,
          label: "1 year"
        }, {
          period: "YTD",
          label: "YTD"
        }, {
          period: "MAX",
          label: "MAX"
        }];
        chart.periodSelector = periodSelector;

        chart.write('chartdiv');
      }
    </script>  

                        
                        <?php
                            foreach ($advertisement as $add_key => $add_value) { 
                                $ad_position   = $add_value->serial_position;
                                $ad_link       = $add_value->url;
                                $ad_script     = $add_value->script;
                                $ad_image      = $add_value->image;
                                $ad_name      = $add_value->name;
                        ?>

                        <?php if (@$ad_position==4) { ?>
                            <div class="widget_banner">
                                <?php if ($ad_script=="") { ?>
                                <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                                <?php } else { echo $ad_script; } ?>
                            </div><!-- /.End of banner -->
                        <?php } } ?>

                        <!-- /.End of banner widget -->
                        <h4 class="widget_title"><?php echo display('news'); ?></h4>

<?php  
    foreach ($news as $news_key => $news_value) {
        $article_id         =   $news_value->article_id;
        $cat_id             =   $news_value->cat_id;
        $slug               =   $news_value->slug;
        $news_headline      =   isset($lang) && $lang =="french"?$news_value->headline_fr:$news_value->headline_en;
        $news_article1      =   isset($lang) && $lang =="french"?$news_value->article1_fr:$news_value->article1_en;
        $news_article_image =   $news_value->article_image;
        $publish_date       =   $news_value->publish_date;

        $cat_slug = $this->db->select("slug, cat_name_en, cat_name_fr")->from('web_category')->where('cat_id', $cat_id)->get()->row();
        $cat_name      =   isset($lang) && $lang =="french"?$cat_slug->cat_name_fr:$cat_slug->cat_name_en;
?>
                        <div class="post post_list post_list_md">
                            <div class="post_img">
                                <a href="<?php echo base_url('news/'.$cat_slug->slug."/$slug"); ?>"><img src="<?php echo base_url($news_article_image); ?>" alt="<?php echo strip_tags($news_headline); ?>"></a>
                            </div>
                            <div class="post_body">
                                <div class="post-cat"><a href="<?php echo base_url('news/'.$cat_slug->slug); ?>"><?php echo $cat_name ?></a></div>
                                <h3 class="post_heading"><a href="<?php echo base_url('news/'.$cat_slug->slug."/$slug"); ?>"><?php echo strip_tags($news_headline); ?></a></h3>
                                <p><?php echo substr(strip_tags($news_article1), 0, 110); ?></p>
                                <div class="post_meta">
                                    <span class="post_date"><i class="fa fa-calendar-o"></i><time datetime="<?php echo $publish_date ?>">
                                            <?php
                                                $date=date_create($publish_date);
                                                echo date_format($date,"jS, F Y");
                                            ?>                                            
                                        </time></span>
                                </div>
                            </div>
                        </div><!-- /.End of post list -->
<?php

    }

?>
                        <!-- /.End of pagination -->

                        <?php
                            foreach ($advertisement as $add_key => $add_value) { 
                                $ad_position   = $add_value->serial_position;
                                $ad_link       = $add_value->url;
                                $ad_script     = $add_value->script;
                                $ad_image      = $add_value->image;
                                $ad_name      = $add_value->name;
                        ?>

                        <?php if (@$ad_position==5) { ?>
                            <div class="widget_banner">
                                <?php if ($ad_script=="") { ?>
                                <a target="_blank" href="<?php echo $ad_link ?> "><img src="<?php echo base_url($ad_image) ?>" class="img-responsive center-block" alt="<?php echo strip_tags($ad_name) ?>"></a>
                                <?php } else { echo $ad_script; } ?>
                            </div><!-- /.End of banner -->
                        <?php } } ?>

                    </div>
                    <?php echo (!empty($content)?$content:null) ?>
                </div>
            </div>
        </div>