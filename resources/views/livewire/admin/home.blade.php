<div>
    <div class="container mt-4">
        <ul class="box-info">
            <li>
                <i class="bx bi-journal-bookmark-fill"></i>
                <span class="text">
                  <small>Total Book</small><br>
                  <b class="fs-4">{{$total_book}}</b>
                </span>
            </li>
            <li>
                <i class="bx bi-journal-check"></i>
                <span class="text">
                    <small>Available Book</small><br>
                  <b class="fs-4">{{$available[1]}}</b>
                </span>
            </li>
            <li>
                <i class="bx bi-journal-minus"></i>
                <span class="text">
                      <small>Not Available Book</small><br>
                  <b class="fs-4">{{$available[0]}}</b>
                </span>
            </li>
        </ul>
        <ul class="box-info">
            <li>
                <i class="bx bi-search"></i>
                <span class="text">
                  <small>Total Search</small><br>
                  <b class="fs-4">{{$total_search}}</b>
                </span>
            </li>
            <li>
                <i class="bx bi-clock"></i>
                <span class="text">
                      <small>Avg Search <br>Response Time</small><br>
                      <b class="fs-4">{{$avg_response_time}} seconds</b>
                </span>
            </li>
            <li>
                <i class="bx bi-journal-richtext"></i>
                <span class="text">
                  <small>Avg Search <br> Best Match</small><br>
                  <b class="fs-4">{{round(($avg_match / 1000) * 100, 1)}}%</b>
            </span>
            </li>
        </ul>
    </div>
</div>
