<?php

namespace App\Http\Controllers\Backend;

use Modules\CongregateBackend\Http\Controllers\BackendBaseController;

class ContactUsManageController extends BackendBaseController
{


  public function indexAction()
  {
    $this->addActiveBreadcrumb("Contact Us");

    return view('backend/contact_us_index');
  }
}
