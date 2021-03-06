<?php

namespace Litepie\Revision\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class RevisionListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RevisionListTransformer();
    }
}