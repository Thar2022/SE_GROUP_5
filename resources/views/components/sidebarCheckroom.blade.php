
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
            <a href="{{ url('/checkroom') }}" class="sidebar-link">
                <i class="lni lni-home"></i>
                
                <span>หน้าหลัก</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('checkroom')}}" class="sidebar-link">
                <i class="lni lni-protection"></i>
                <span>จัดการการตรวจห้อง</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('history_check')}}" class="sidebar-link">
                <i class="lni lni-protection"></i>
                <span>ประวัติการตรวจห้อง</span>
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