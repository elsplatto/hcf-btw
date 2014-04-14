<section class="itineraryTileHolder marginBottomStandard">
    <div class="row">
        <div class="large-12">
            <h3 class="text-center">Recommended Itineraries</h3>
            <div class="large-6 medium-6 small-12 columns marginTop40">
                <div class="itineraryTile" style="background-image: url('<?=$baseURL?>/img/it/tile/entertainment.jpg'); background-repeat: no-repeat; background-size: cover;">
                    <div class="inner">
                        <div class="textHolder">
                            <span>Itinerary – by Sam Hindmarsh</span>
                            <h3><a href="<?=$baseURL?>/docs/beyondthewharf-entertainment.pdf" target="_blank">Night on the Town</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($friendly_url == 'parramatta-river')
            {
            ?>
            <div class="large-6 medium-6 small-12 columns marginTop40">
                <div class="itineraryTile" style="background-image: url('<?=$baseURL?>/img/it/tile/itin-parramattapark.jpg'); background-repeat: no-repeat; background-size: cover;">
                    <div class="inner">
                        <div class="textHolder">
                            <span>Itinerary – by Councillor Pierre Esber</span>
                            <h3><a href="<?=$baseURL?>/docs/beyondthewharf-parramatta.pdf" target="_blank">Parramatta Pioneer Trail</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            else
            {
            ?>
            <div class="large-6 medium-6 small-12 columns marginTop40">
                <div class="itineraryTile" style="background-image: url('<?=$baseURL?>/img/it/tile/tile-1.jpg'); background-repeat: no-repeat; background-size: cover;">
                    <div class="inner">
                        <div class="textHolder">
                            <span>Itinerary – by Belinda Tobias</span>
                            <h3><a href="<?=$baseURL?>/docs/beyondthewharf-family.pdf" target="_blank">Sunday - Family Day</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>