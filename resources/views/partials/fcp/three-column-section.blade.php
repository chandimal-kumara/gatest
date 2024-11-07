@php
  $column1 = get_sub_field('fcp_three_col_new_column1');
  $column2 = get_sub_field('fcp_three_col_new_column2');
  $column3 = get_sub_field('fcp_three_col_new_column3');
@endphp

@if ($column1 && $column2 && $column3)
  <section class="fcp-section three-column-section-new stick-all">
    <div class="section-inner-wrp">
      <div class="three-column-wrp row">
        @php
          $contentOptionsCol1 = $column1['three_col1_new_content_options'];
          $imageCol1 = $column1['three_col1_new_image'];
          $backgroundCol1 = $column1['three_col1_new_background'];
          $contentCol1 = $column1['three_col1_new_content'];
          $buttonCol1 = $column1['three_col1_new_button'];

          if ($buttonCol1) {
            $buttonClassCol1 = 'has-one-button';
          } else {
            $buttonClassCol1 = '';
          }

          if ($backgroundCol1 == 'color-1') {
            $hasBackground1 = "has-background color-1";
          } elseif ($backgroundCol1 == 'color-2') {
            $hasBackground1 = "has-background color-2";
          } else {
            $hasBackground1 = "";
          }

          $contentOptionsCol2 = $column2['three_col2_new_content_options'];
          $imageCol2 = $column2['three_col2_new_image'];
          $backgroundCol2 = $column2['three_col2_new_background'];
          $contentCol2 = $column2['three_col2_new_content'];
          $buttonCol2 = $column2['three_col2_new_button'];

          if ($buttonCol2) {
            $buttonClassCol2 = 'has-one-button';
          } else {
            $buttonClassCol2 = '';
          }

          if ($backgroundCol2 == 'color-1') {
            $hasBackground2 = "has-background color-1";
          } elseif ($backgroundCol2 == 'color-2') {
            $hasBackground2 = "has-background color-2";
          } else {
            $hasBackground2 = "";
          }

          $contentOptionsCol3 = $column3['three_col3_new_content_options'];
          $imageCol3 = $column3['three_col3_new_image'];
          $backgroundCol3 = $column3['three_col3_new_background'];
          $contentCol3 = $column3['three_col3_new_content'];
          $buttonCol3 = $column3['three_col3_new_button'];

          if ($buttonCol3) {
            $buttonClassCol3 = 'has-one-button';
          } else {
            $buttonClassCol3 = '';
          }

          if ($backgroundCol3 == 'color-1') {
            $hasBackground3 = "has-background color-1";
          } elseif ($backgroundCol3 == 'color-2') {
            $hasBackground3 = "has-background color-2";
          } else {
            $hasBackground3 = "";
          }
        @endphp
        <div class="three-col-item col-12 col-md-6 col-xl-4">
          <div class="content-wrp h-100">
            @if ($contentOptionsCol1 == 'image')
              <div class="image-wrapper h-100">
                <img src="@php echo esc_url($imageCol1['url']); @endphp" alt="@php echo esc_attr($imageCol1['alt']); @endphp">
              </div>
            @endif
            @if ($contentOptionsCol1 == 'content')
              <div class="description-wrp {{$hasBackground1}} {{$buttonClassCol1}} h-100 d-flex justify-content-center flex-column">
                <div class="description-wrp-inner editor-content-wrp">
                  @php
                    echo $contentCol1;
                  @endphp
                </div>
                @if ($buttonCol1)
                  <div class="button-wrp">
                    @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$buttonCol1['url'], 'buttonTitle'=>$buttonCol1['title'], 'buttonTarget'=>$buttonCol1['target']])
                  </div>
                @endif
              </div>
            @endif
          </div>
        </div>
        <div class="three-col-item col-12 col-md-6 col-xl-4">
          <div class="content-wrp h-100">
            @if ($contentOptionsCol2 == 'image')
              <div class="image-wrapper h-100">
                <img src="@php echo esc_url($imageCol2['url']); @endphp" alt="@php echo esc_attr($imageCol2['alt']); @endphp">
              </div>
            @endif
            @if ($contentOptionsCol2 == 'content')
              <div class="description-wrp {{$hasBackground2}} {{$buttonClassCol2}} h-100 d-flex justify-content-center flex-column">
                <div class="description-wrp-inner editor-content-wrp">
                  @php
                    echo $contentCol2;
                  @endphp
                </div>
                @if ($buttonCol2)
                  <div class="button-wrp">
                    @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$buttonCol2['url'], 'buttonTitle'=>$buttonCol2['title'], 'buttonTarget'=>$buttonCol2['target']])
                  </div>
                @endif
              </div>
            @endif
          </div>
        </div>
        <div class="three-col-item col-12 col-xl-4">
          <div class="content-wrp h-100">
            @if ($contentOptionsCol3 == 'image')
              <div class="image-wrapper h-100">
                <img src="@php echo esc_url($imageCol3['url']); @endphp" alt="@php echo esc_attr($imageCol3['alt']); @endphp">
              </div>
            @endif
            @if ($contentOptionsCol3 == 'content')
              <div class="description-wrp {{$hasBackground3}} {{$buttonClassCol3}} h-100 d-flex justify-content-center flex-column">
                <div class="description-wrp-inner editor-content-wrp">
                  @php
                    echo $contentCol3;
                  @endphp
                </div>
                @if ($buttonCol3)
                  <div class="button-wrp">
                    @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$buttonCol3['url'], 'buttonTitle'=>$buttonCol3['title'], 'buttonTarget'=>$buttonCol3['target']])
                  </div>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endif
