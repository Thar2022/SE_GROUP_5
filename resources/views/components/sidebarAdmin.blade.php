<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="">ชื่อuser</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        
        <li class="sidebar-item">
            <a href="{{ url('/admin/home') }}" class="sidebar-link">
                <i class="lni lni-home"></i>
                
                <span>หน้าหลัก</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ url('/admin/register') }}" class="sidebar-link">
                <i class="lni lni-protection"></i>
                <span>จัดการผู้ใช้ทั้งหมด</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a  class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="lni lni-agenda"></i>
                <span>จัดการการจองห้อง</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ url('/admin/allBooking') }}" class="sidebar-link">การจองห้อง</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('bookingadmin') }}" class="sidebar-link">การจัดการการจองห้องของuser</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ url('/admin/changeRoom') }}" class="sidebar-link">การจองที่รอเปลี่ยนห้อง</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ url('/admin/closeRoom') }}" class="sidebar-link">การปิดห้อง</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
        <a  class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#re" aria-expanded="false" aria-controls="re">
                <i class="lni lni-agenda"></i>
                <span>ซ่อม</span>
            </a>
                <ul id="re" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{route('report')}}" class="sidebar-link">sssss</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('booking')}}" class="sidebar-link">การจองห้อง</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ url('/admin/closeroom') }}" class="sidebar-link">การปิดห้อง</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('book_status')}}" class="sidebar-link">ประวัติการจอง</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('bookinguser')}}" class="sidebar-link">จัดการการจองห้องของuser</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{route('bookingadmin')}}" class="sidebar-link">จัดการการจองห้องของadmin</a>
                    </li>
                </ul>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ url('/admin/meetingRoom') }}" class="sidebar-link">
                <i class="lni lni-popup"></i>
                <span>จัดการการห้องและอุปกรณ์</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>โปรไฟล์</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>ออกจากระบบ</span>
        </a>
    </div>
</aside>