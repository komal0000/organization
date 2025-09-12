  @php
      $data = getSetting('homeFAQ');
  @endphp
  <div class="col-md-6">
      <div class="title">{{ $data->title ?? 'Recently asked questions' }}</div>
      <div class="subtitle">
          {{ $data->subtitle ?? 'People are frequently asking some questions from us' }}
      </div>
      <div class="semi">
          {{ $data->semi ??
              " Proactively procrastinate cross-platform results via extensive ideas distinctively underwhelm enterprise.
                    Compellingly plagiarize value-added sources with inexpensive schemas." }}
      </div>
      <div class="d-none d-md-block">
          <a href="/faqs" class="more">
              {{ $data->bottom_text ?? 'More FAQ' }}
          </a>
      </div>
  </div>
