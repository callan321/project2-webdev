- [x] There are two types of users of this system:
  a. Teachers, and  
  b. Students.  
  Students need to register before they can login. Students need to supply their name, email, and s-number when they register. Teachers are simply seeded into the database. For testing purpose, there should be sufficient seeded teachers and students.

- [x] All users need to login before they can access the functionalities of this system. Users login with their s-number and password. Once a user logs in, their name and user type (teacher or student) will be displayed at the top of every page.

- [x] A logged-in user should be able to log out.

- [x] Home page: once logged in, the user can see a list of courses they are enrolled in or teaching. As per real-world, a student can enrol into multiple courses, and a teacher can teach multiple courses. A course has a course code and name. Clicking on a course brings the user to the course details page.

- [x] Details page for a course displays the teachers and the list of (peer review) assessments for this course (e.g. Week 1 Peer Review). Next to each assessment, it should display its due date. User can click on an assessment to bring them to the details page for that assessment.

- [ ] Teacher can manually enrol a registered student into a course.

- [ ] From the course details page, a teacher can add a peer review assessment to this course. A peer review assessment should contain an assessment title (up to 20 characters), instruction (free text), the number of reviews required to be submitted (a number 1 or above), maximum score (between 1 and 100 inclusive), a due date and time, and a type. There are two types of peer review: student-select and teacher-assign (reviewee).

- [ ] Teachers are allowed to update a peer review assessment, unless there has already been a submission. When updating, the old value should be shown.

- [ ] The details page for an assessment for students has the following functionalities:
  a. Allows students to submit their peer review. This page displays the assessment title, instruction, number of required reviews, submitted review, and due date. For peer reviews that are of “student-select” type, students select their reviewees (from a dropdown menu of all students in this course) and enter their review text (free text with at least 5 words). Students need to be able to submit the required number of reviews for this assessment. The system needs to ensure each review submitted must be for a different reviewee.  
  b. Displays the peer reviews received by this student for this assessment, including the name of the reviewer.

- [ ] The details page for an assessment for teachers can only be accessed by teachers of this course for marking. This page will list all students in the course, and for each student, it shows how many reviews this student has submitted and received, and the score for this assessment. Clicking on a student will show a page containing all the reviews submitted and received by this student. The teacher can then assign a score to this student for this assessment.

- [ ] There is pagination in the marking page that lists all students. A page is limited to 10 students. You need to have sufficient initial data to show your pagination works.

- [ ] A teacher can upload a text file containing course information, which includes the course name, teachers, assessments, and the students enrolled in this course. Uploading this file will result in a new course being created in the system with the supplied assessments, teachers, and students/enrollments. The system should check that the course, with the same course code, does not already exist. It is possible for students in the list to have yet to register with this system. You should have a file prepared to demonstrate this feature.

- [ ] Design a feature to encourage reviewers to submit useful reviews for their reviewee without requiring reviews to be marked. A base solution would be for reviewees to rate the reviewer (say out of 5), then there is a page all users can access that lists the 5 reviewers with the highest average rating. For full marks, design a more innovative working solution and provide a convincing argument why your solution is better at encouraging good reviews.

- [ ] There are two types of peer review, “student-select” as described in 9a, and “teacher-assign.” Design and implement teacher-assign. In this type, the teacher randomly assigns students to peer review groups for each peer review. Students only review other students in their assigned group. This system should support:
  a. Being able to obtain the correct information regarding which student has been assigned to which group.  
  b. Students can only submit reviews for students in the assigned group.
