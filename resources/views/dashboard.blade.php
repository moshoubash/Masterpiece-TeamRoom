@extends('layouts.dashboard.layout')
@section('title', 'Meeting Room Booking Dashboard')
@section('content')
    <h1 class="h3 mb-3"><strong>Meeting Room</strong> Dashboard</h1>

    <!-- Top Row - 4 Small Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">${{ $totalRevenue }}</h3>
                            <p class="text-muted mb-0">All Earnings</p>
                        </div>
                        <div class="col-4 text-end">
                            <i class="ti ti-currency-dollar text-success f-36"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $totalUsers }}</h3>
                            <p class="text-muted mb-0">All Users</p>
                        </div>
                        <div class="col-4 text-end">
                            <i class="ti ti-users text-primary f-36"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $totalBookings }}</h3>
                            <p class="text-muted mb-0">All Bookings</p>
                        </div>
                        <div class="col-4 text-end">
                            <i class="ti ti-calendar-event text-info f-36"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $totalSpaces }}</h3>
                            <p class="text-muted mb-0">All Spaces</p>
                        </div>
                        <div class="col-4 text-end ">
                            <i class="ti ti-home text-warning f-36"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle Row - Two Charts -->
    <div class="row">
        <!-- Left Chart - Circle -->
        <div class="col-12 col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Room Utilization</h5>
                </div>

                <div class="card-body">
                    <div id="roomUtilizationChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Right Chart - Line Graph -->
        <div class="col-12 col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Booking per day</h5>
                </div>
                <div class="card-body">
                    <div id="bookingTrendsChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row - Table + Sidebar -->
    <div class="row">
        <!-- Main Table - Meeting Rooms -->
        <div class="col-12 col-xl-9 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Room Availability</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="60">ID</th>
                                    <th width="80">Image</th>
                                    <th>Title</th>
                                    <th class="text-center" width="80">Capacity</th>
                                    <th class="text-end" width="100">Hourly Rate</th>
                                    <th class="text-center" width="120">Min Duration</th>
                                    <th class="text-center" width="80">Status</th>
                                    <th class="text-center" width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spaces->sortByDesc('created_at') as $space)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $space->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $space->images->first()->image_url ?? '') }}"
                                                alt="{{ $space->title }}" class="img-fluid rounded">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>{{ $space->title }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $space->capacity }}</td>
                                        <td class="text-end fw-medium">${{ number_format($space->hourly_rate, 2) }}</td>
                                        <td class="text-center">{{ $space->min_booking_duration }} hrs</td>
                                        <td class="text-center">
                                            @if ($space->is_deleted)
                                                <span class="badge bg-danger">Deleted</span>
                                            @elseif($space->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="/dashboard/spaces/{{ $space->id }}" class="btn btn-sm btn-info"
                                                    data-bs-toggle="tooltip" title="View Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="/dashboard/spaces/{{ $space->id }}/edit"
                                                    class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                    title="Edit Space">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $space->id }}"
                                                    data-bs-toggle="tooltip" title="Delete Space">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $space->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Delete Space</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-3">
                                                                <i
                                                                    class="fa-solid fa-triangle-exclamation text-danger fa-3x mb-3"></i>
                                                                <h5>Are you sure you want to delete this space?</h5>
                                                                <p class="text-muted mb-0">Space:
                                                                    <strong>{{ $space->title }}</strong></p>
                                                                <p class="text-muted">This action cannot be undone.</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times me-1"></i> Cancel
                                                            </button>
                                                            <form action="/dashboard/spaces/{{ $space->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fa-solid fa-trash me-1"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $spaces->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar - Vertical Section -->
        <div class="col-12 col-xl-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Peak Hours</h5>
                </div>
                <div class="card-body">
                    <div id="peakHoursChart" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ApexCharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Room Utilization Chart (Donut)
            var roomUtilizationOptions = {
                series: [65, 35],
                chart: {
                    type: 'donut',
                    height: 300,
                    fontFamily: 'Inter, sans-serif'
                },
                labels: ['Booked', 'Available'],
                colors: ['#3B82F6', '#E5E7EB'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + "%";
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Rooms',
                                    formatter: function(w) {
                                        return '{{ $totalRooms ?? 0 }}';
                                    }
                                }
                            }
                        }
                    }
                }
            };

            var roomUtilizationChart = new ApexCharts(document.querySelector("#roomUtilizationChart"),
                roomUtilizationOptions);
            roomUtilizationChart.render();

            // Booking Trends Chart (Line)
            var bookingTrendsOptions = {
                series: [{
                    name: 'Bookings',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 150, 135, 160]
                }],
                chart: {
                    type: 'line',
                    height: 300,
                    fontFamily: 'Inter, sans-serif',
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#3B82F6'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ]
                },
                yaxis: {
                    title: {
                        text: 'Number of Bookings'
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4
                },
                markers: {
                    size: 4,
                    colors: ['#3B82F6'],
                    strokeColors: '#fff',
                    strokeWidth: 2
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " bookings";
                        }
                    }
                }
            };

            var bookingTrendsChart = new ApexCharts(document.querySelector("#bookingTrendsChart"),
                bookingTrendsOptions);
            bookingTrendsChart.render();

            // Peak Hours Chart (Vertical Bar)
            var peakHoursOptions = {
                series: [{
                    name: 'Bookings',
                    data: [12, 19, 27, 30, 32, 29, 22, 18, 14, 9]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    fontFamily: 'Inter, sans-serif',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        vertical: true,
                        columnWidth: '65%',
                        distributed: false,
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val;
                    },
                    offsetY: -20
                },
                colors: ['#3B82F6'],
                xaxis: {
                    categories: ['8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm'],
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    title: {
                        text: 'Bookings'
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4
                }
            };

            var peakHoursChart = new ApexCharts(document.querySelector("#peakHoursChart"), peakHoursOptions);
            peakHoursChart.render();
        });
    </script>
@endsection
