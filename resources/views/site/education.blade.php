@extends('layouts.site')

@section('content')
    <div class="education_page">
        <div class="breadcrumbs">
            <a href="/">Home</a>
            <span class="divider">|</span>
            <span>Education</span>
        </div>
        <h1 class="page_title">
            Educational
        </h1>
        <div class="container">
            <div class="banner__in education">
                <div class="banner__title">Leading importer and wholesale distributor of Esthetics Supplies in Canada</div>
                <div class="banner__text">
                    Continental Cosmetics Ltd. is a leading importer and wholesale distributor of Esthetics Supplies in Canada, with many exclusive international brands, including Gehwol Foot Care. With a vast array of high-quality Skin Care, Body Care, Depilatory products, and various other miscellaneous items, Continental Cosmetics is well equipped to provide everything you need, including training and consulting services to help you grow your business.
                </div>
            </div>
            <div class="calendar">
                <div class="calendar__title">Educational program calendar</div>
                <div class="calendar__filter d-flex align-center">
                    <div class="calendar__filter_item d-flex align-center">
                        <div class="text">Select a month:</div>
                        <select>
                            <option value="April">April</option>
                            <option value="April">April</option>
                            <option value="April">April</option>
                            <option value="April">April</option>
                            <option value="April">April</option>
                            <option value="April">April</option>
                        </select>
                    </div>
                    <div class="calendar__filter_item d-flex align-center">
                        <div class="text">Show as:</div>
                        <select>
                            <option value="April">Current 7 days</option>
                            <option value="Current 7 days">Current 7 days</option>
                            <option value="Current 7 days">Current 7 days</option>
                            <option value="Current 7 days">Current 7 days</option>
                            <option value="Current 7 days">Current 7 days</option>
                            <option value="Current 7 days">Current 7 days</option>
                        </select>
                    </div>
                </div>
                <div class="calendar__week">
                    <div class="calendar__week_day">Mon</div>
                    <div class="calendar__week_day">Tue</div>
                    <div class="calendar__week_day">Wed</div>
                    <div class="calendar__week_day">Thu</div>
                    <div class="calendar__week_day">Fri</div>
                    <div class="calendar__week_day">Sat</div>
                    <div class="calendar__week_day">Sun</div>
                </div>
                <div class="calendar__body">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="calendar__item is_disabled">
                            <div class="calendar__item_top">
                                <div class="date">
                                    <div class="left">{{ 28 + $i }}</div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @for ($i = 0; $i < 9; $i++)
                        <a href="/education/event" class="calendar__item">
                            <div class="calendar__item_top">
                                <div class="date">
                                    <div class="left">{{ 0 . ($i + 1) }}</div>
                                    <div class="right">Virtual Event</div>
                                </div>
                                <div class="text">
                                    Uniqcure  and mymask, mini facials to maximize your treatments
                                </div>
                            </div>
                            <div class="calendar__item_bottom">
                                <div class="time">
                                    <div class="icon">
                                        <svg width="100%" viewBox="0 0 15 15" fill="#A5A5A5"><path d="M7.5 0C3.3646 0 0 3.36442 0 7.5C0 11.6356 3.3646 15 7.5 15C11.6356 15 15 11.6356 15 7.5C15 3.36442 11.6354 0 7.5 0ZM7.5 13.9051C3.96826 13.9051 1.09488 11.0317 1.09488 7.5C1.09488 3.96826 3.96826 1.09488 7.5 1.09488C11.0317 1.09488 13.9051 3.96823 13.9051 7.49982C13.9051 11.0317 11.0317 13.9051 7.5 13.9051Z"/><path d="M10.0547 7.49999H7.68249V4.21532C7.68249 3.91294 7.43742 3.66787 7.13505 3.66787C6.83267 3.66787 6.58761 3.91294 6.58761 4.21532V8.04744C6.58761 8.34981 6.83267 8.59488 7.13505 8.59488H10.0547C10.3571 8.59488 10.6022 8.34981 10.6022 8.04744C10.6022 7.74506 10.3571 7.49999 10.0547 7.49999Z"/></svg>
                                    </div>
                                    <div class="text">
                                        <div>12:00 pm -</div>
                                        <div>01:00 pm</div>
                                    </div>
                                </div>
                                <div class="arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 27 23" fill="#E45A54"><path d="M25.6974 10.4353H1.08582C0.486112 10.4353 0 10.9123 0 11.5001C0 12.0879 0.486059 12.5649 1.08582 12.5649H25.6974C26.2971 12.5649 26.7832 12.0882 26.7832 11.5001C26.7832 10.9119 26.2971 10.4353 25.6974 10.4353Z"/><path d="M26.6818 10.7469L16.0413 0.311727C15.6171 -0.103909 14.9302 -0.103909 14.506 0.311727C14.0818 0.727725 14.0818 1.40209 14.506 1.81773L24.3789 11.5L14.506 21.1824C14.0818 21.598 14.0818 22.2724 14.506 22.688C14.7181 22.896 14.9957 23 15.2737 23C15.5516 23 15.8292 22.896 16.0413 22.688L26.6818 12.2529C27.106 11.8369 27.106 11.1625 26.6818 10.7469Z"/></svg>
                                </div>
                            </div>
                        </a>
                    @endfor
                    @for ($i = 0; $i < 2; $i++)
                        <div class="calendar__item is_disabled">
                            <div class="calendar__item_top">
                                <div class="date">
                                    <div class="left">{{ $i + 10 }}</div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
