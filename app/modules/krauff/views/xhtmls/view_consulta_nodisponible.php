<?php
if (!isset($DOM["SECURITY_ID"])) {
    echo "<h1>MOON2 Message:<br />Can not call view, requires the view controller</h1>";
    exit();
}
?>
<div class="middle-box">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success">INFORMACIÓN</span>
            </div>
            <div class="ibox-content ibox-heading">
                <h3>Usted no asistió al congreso.
                    <div class="stat-percent text-success"><i class="fa fa-desktop"></i></div>
                </h3>
            </div>
            <div class="client-detail">
                <div class="full-height-scroll">
                    <div class="ibox-content inspinia-timeline">
                        <div class="feed-element">
                            <div class="media-body ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>