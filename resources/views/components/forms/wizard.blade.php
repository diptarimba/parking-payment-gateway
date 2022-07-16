<div class="mt-4">
    <div class="col-12 col-xl-10 order-1 order-xl-0">
        <div class="card shadow-none border border-300 my-4" data-component-card>
            <div class="card-header p-4 border-bottom border-300 bg-soft">
              <div class="row g-3 justify-content-between align-items-center">
                <div class="col-12 col-md">
                    {{  $header  }}
                </div>
              </div>
            </div>
            <div class="card-body">
                {{ $slot }}
            </div>
            <div class="card-footer">
                {{ $footer }}
            </div>
          </div>
    </div>
</div>
