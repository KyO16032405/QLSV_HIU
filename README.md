# Hệ thống quản lý sinh viên

Dự án là một ứng dụng web được xây dựng bằng **Laravel**, sử dụng giao diện **AdminLTE**, nhằm hỗ trợ quản lý thông tin và kết quả học tập của sinh viên trong một cơ sở giáo dục.  

Hệ thống cung cấp các chức năng chính như:  

- ✅ **Quản lý điểm**: Lưu trữ và hiển thị điểm tổng (`diemtong`) theo học kỳ, năm học, lớp học, dựa trên dữ liệu từ bảng `diems`.  
- ✅ **Xét điều kiện học tập**:  
  - Tự động đánh giá học lực (**Giỏi, Khá, Trung bình, v.v.**).  
  - Xác định khả năng lên lớp (**diemtong > 5**).  
  - Xét học bổng (**diemtong > 8**).  
- ✅ **Quản lý điểm rèn luyện**:  
  - Cập nhật và theo dõi điểm rèn luyện (`diemrl`) qua bảng `thongkes`.  
  - Cho phép quản trị viên chỉnh sửa trực tiếp.  
- ✅ **Xem và xuất dữ liệu**:  
  - Hiển thị danh sách **môn học, giáo viên, lớp, sinh viên học lại, thi lại, lên lớp, đạt học bổng**.  
  - Hỗ trợ xuất dữ liệu ra **Excel và PDF**.  
- ✅ **Liên kết hệ thống**:  
  - Dữ liệu đồng bộ giữa các bảng **sinhviens, lops, monhocs, hockys, phancong, diems**.  
  - Đảm bảo cung cấp thông tin đầy đủ, chính xác và minh bạch.  

---

## 🔸 Những tính năng chưa hoàn thiện:
- ❌ **Lọc dữ liệu nâng cao** (lọc theo tiêu chí cụ thể, tìm kiếm linh hoạt).  
- ❌ **Đăng ký tài khoản và quản lý người dùng**.  
- ❌ **Gửi email thông báo** (ví dụ: thông báo điểm, cảnh báo học lực).  
- ❌ **Chỉnh sửa dữ liệu** (chưa hoàn thiện tính năng **thêm, sửa, xóa**).  

---

## 🚀 Định hướng phát triển  
💡 Mình chưa có nhiều kinh nghiệm nhưng sẽ tiếp tục phát triển và hoàn thiện hệ thống trong thời gian tới.  

Mọi góp ý, hỗ trợ và đóng góp từ cộng đồng đều được hoan nghênh! 😊
