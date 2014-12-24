{{-- Docs Popup--}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel">Rabbit Generator</h3>
            </div>

            <div class="modal-body">
                <?php

                // Docs
                $file = File::get(Config::get('cpanel::path.doc') . 'generator.md');
                $document = MarkdownPlus::make($file);
                $doc = $document->getContent();
                echo $doc;

                ?>
            </div>

        </div>
    </div>
</div>
