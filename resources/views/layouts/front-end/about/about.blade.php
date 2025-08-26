@extends('layouts.front-end.layouts-custom.layouts-custom')

@section('title', 'About - Portal ITSA')

@section('content')
  {{-- ABOUT SECTION --}}
  <section class="about-portal" id="tentang" style="padding-top: 100px; padding-bottom: 100px; background-color: #f8f9fa; overflow: visible;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="fw-bold mb-4">About ITSA Portal</h2>
          <div class="divider mx-auto my-4"></div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 40px;">
            <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: justify;">
              The ITSA portal is the main gateway to internal digital systems of <strong>PT Indonesia Thai Summit Auto</strong>.
            </p>
            <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: justify;">
              Through this portal, employees can access various important services such as:
            </p>
            <ul class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; padding-left: 30px;">
              <li style="margin-bottom: 15px; list-style-type: disc;">
                <strong>Document Action Request (DAR)</strong>: for document submission, approval and tracking.
              </li>
              <li style="margin-bottom: 15px; list-style-type: disc;">
                <strong>Digital Asset Registration</strong>: for secure management of corporate digital assets.
              </li>
              <li style="margin-bottom: 15px; list-style-type: disc;">
                <strong>IT Request</strong>: for submitting IT support requests and tracking their status.
               </li>
                <li style="margin-bottom: 15px; list-style-type: disc;">
                  <strong>IT Maintenance Order</strong>: for scheduling and managing IT equipment maintenance.
                </li>
                <li style="margin-bottom: 15px; list-style-type: disc;">
                  <strong>IT Borrowing</strong>: for managing the borrowing of IT equipment and resources.
                </li>
            </ul>
            <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: justify;">
              This portal is designed to facilitate service integration and increase efficiency and productivity across all company units.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  </section>
  @endsection