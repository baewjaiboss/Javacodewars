-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 07:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `javacodewars`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` char(10) COLLATE utf8mb4_bin NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_status` char(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `course_id`, `student_id`, `question_id`, `answer_status`) VALUES
(3, 20, '5909610304', 82, 'Pass'),
(4, 21, '5909610304', 93, 'Pass'),
(5, 21, '5909610304', 82, 'Error');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` char(5) COLLATE utf8mb4_bin NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_name` char(50) COLLATE utf8mb4_bin NOT NULL,
  `course_status` char(10) COLLATE utf8mb4_bin NOT NULL,
  `teacher_user` char(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_year`, `course_name`, `course_status`, `teacher_user`) VALUES
(1, 'cs111', 2560, 'OBJECT-ORIENTED CONCEPTS', 'Hide', 'baewjaiboss'),
(4, 'cs111', 2562, 'OBJECT-ORIENTED CONCEPTS', 'Open', 'baewjaiboss'),
(5, 'cs111', 2018, 'OBJECT-ORIENTED CONCEPTS', 'Open', 'Sukanya'),
(6, 'cs111', 2019, 'OBJECT-ORIENTED CONCEPTS', 'Open', 'Sukanya'),
(7, 'cs111', 20120, 'OBJECT-ORIENTED CONCEPTS', 'Open', 'Sukanya'),
(14, 'cs111', 2311, 'OOAD', 'Open', 'baewjaiboss'),
(20, 'cs111', 2561, 'ABCD', 'Hide', 'Natacha Punlai'),
(21, 'cs111', 2562, 'OOP-1', 'Open', 'Natacha Punlai');

-- --------------------------------------------------------

--
-- Table structure for table `coursequestion`
--

CREATE TABLE `coursequestion` (
  `course_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `coursequestion`
--

INSERT INTO `coursequestion` (`course_id`, `question_id`) VALUES
(0, 68),
(1, 37),
(1, 41),
(1, 42),
(1, 65),
(1, 68),
(1, 79),
(4, 41),
(4, 42),
(4, 65),
(4, 68),
(7, 37),
(14, 41),
(14, 42),
(14, 65),
(14, 68),
(20, 82),
(20, 92),
(20, 93),
(21, 80),
(21, 82),
(21, 92),
(21, 93);

-- --------------------------------------------------------

--
-- Table structure for table `coursestudent`
--

CREATE TABLE `coursestudent` (
  `course_id` int(11) NOT NULL,
  `student_id` char(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `coursestudent`
--

INSERT INTO `coursestudent` (`course_id`, `student_id`) VALUES
(20, '5909610301'),
(20, '5909610302'),
(20, '5909610303'),
(20, '5909610304'),
(20, '5909610305'),
(20, '5909610306'),
(21, '5909610301'),
(21, '5909610302'),
(21, '5909610303'),
(21, '5909610304'),
(21, '5909610305'),
(21, '5909610306');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question_name` char(50) COLLATE utf8mb4_bin NOT NULL,
  `question_proposition` text COLLATE utf8mb4_bin NOT NULL,
  `question_point` int(3) NOT NULL,
  `question_guide` text COLLATE utf8mb4_bin NOT NULL,
  `question_example` text COLLATE utf8mb4_bin NOT NULL,
  `teacher_user` char(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_name`, `question_proposition`, `question_point`, `question_guide`, `question_example`, `teacher_user`) VALUES
(41, 'Calculator0', ' Calculator0Calculator0Calculator0Calculator0', 5, ' public class Calculator0 {\r\n   public static int add(int number1, int number2) {\r\n      return number1 + number2;\r\n   }\r\n \r\n   public static int sub(int number1, int number2) {\r\n      return number1 - number2;\r\n   }\r\n \r\n   public static int mul(int number1, int number2) {\r\n      return number1 * number2;\r\n   }\r\n \r\n   \r\n   public static int divInt(int number1, int number2) {\r\n      if (number2 == 0) {\r\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\r\n      }\r\n      return number1 / number2;\r\n   }\r\n \r\n   \r\n   public static double divReal(int number1, int number2) {\r\n      if (number2 == 0) {\r\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\r\n      }\r\n      return (double) number1 / number2;\r\n   }\r\n}', '', 'baewjaiboss'),
(42, 'Dog', 'Dog Dog Dog Dog Dog ', 3, 'public class Dog {\r\n    private String mDogName;\r\n    private String mDogBreed;\r\n    private int mDogAge;\r\n    private int mDogWeight;\r\n    private boolean mDogIsHappy;\r\n    public Dog(String name, String breed){\r\n        this.mDogName = name;\r\n        this.mDogBreed = breed;\r\n        this.mDogWeight = 5;\r\n    }\r\n    public String getName(){\r\n        return mDogName;\r\n    }\r\n    public void setName(String name){\r\n        mDogName = name;\r\n    }\r\n    public int getWeight(){\r\n        return mDogWeight;\r\n    }\r\n    public void setWeight(int weight){\r\n        mDogWeight = weight;\r\n    }\r\n    public void eat(){\r\n        System.out.println(\"Yuum that was delicious\");\r\n        mDogWeight += 5;\r\n    }\r\n    public void play(){\r\n        mDogIsHappy = true;\r\n    }\r\n}', '', 'baewjaiboss'),
(65, 'Calculation3', 'เครื่องคิดเลข', 3, 'import java.util.StringTokenizer;\npublic class Calculation3 {  \n    \n    public static int findMax(int arr[]){  \n        int max=0;  \n        for(int i=1;i<arr.length;i++){  \n            if(max<arr[i])  \n                max=arr[i];  \n        }  \n        return max;  \n    }  \n   \n    public static int cube(int n){  \n        return n*n*n;  \n    }  \n   \n    public static String reverseWord(String str){  \n  \n        StringBuilder result=new StringBuilder();  \n        StringTokenizer tokenizer=new StringTokenizer(str,\" \");  \n  \n        while(tokenizer.hasMoreTokens()){  \n        StringBuilder sb=new StringBuilder();  \n        sb.append(tokenizer.nextToken());  \n        sb.reverse();  \n  \n        result.append(sb);  \n        result.append(\" \");  \n        }  \n        return result.toString();  \n    }  \n}  ', '', 'baewjaiboss'),
(68, 'MyNumber', 'You don\'t have my number\nWe don\'t need each other now\nAnd we don\'t need the city\nThe creed or the culture now\nYou don\'t have my number\nAnd we don\'t need each other now\nAnd we don\'t need each other now\n\n\nhuhu', 8, 'public class MyNumber {\nint number;\n   public MyNumber() {\n      this.number = 1;\n\n   }\n\n   public MyNumber(int number) {\n      this.number = number;\n   }\n \n  \n   public int getNumber() {\n      return number;\n   }\n \n   public void setNumber(int number) {\n      this.number = number;\n   }\n \n  \n   public MyNumber add(MyNumber rhs) {\n      this.number += rhs.number;\n      return this;\n   }\n \n   public MyNumber div(MyNumber rhs) {\n      if (rhs.number == 0) throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      this.number /= rhs.number;\n      return this;\n\n\n   }\n}', '', 'baewjaiboss'),
(80, 'Calculation', 'ให้นักศึกษาเขียน class Calculation ที่สามารถค้นหาตัวเลขที่มากที่สุดใน array \nโดยมี method int findMax(int arr[]) {} ให้การค้นหาตัวเลขที่มากที่สุด', 1, 'public class Calculation {\npublic static int findMax(int arr[]){  \n        int max = -100 ;  \n        for(int i=1;i<arr.length;i++){  \n            if(max < arr[i])  \n                max = arr[i];  \n        }  \n        return max;  \n    }  \n}', 'Calculation.findMax(new int[]{10,20,30,40})) // return 40', 'Natacha Punlai'),
(82, 'CalculatorOne', 'ให้นักศึกษาเขียน class CalculatorOne ที่สามารถคำนวณตัวเลขได้โดยมี \nmethod add เป็นการบวกตัวเลขจำนวนเต็ม 2 ตัว \nmethod subtract เป็นการลบตัวเลขจำนวนเต็ม 2 ตัว\nmethod multiply เป็นการคูณตัวเลขจำนวนเต็ม 2 ตัว', 2, 'public class CalculatorOne {\npublic CalculatorOne() {}\n  \n   \n    public int add(int a, int b) {\n        return a + b;\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', 'CalculatorOne.Add(10,10) //return 20\nCalculatorOne.subtract(15,15) //return 0\nCalculatorOne.multiply(2,5) //return 10', 'Natacha Punlai'),
(83, 'CalculatorOne', '7', 7, 'public class CalculatorOne {}', '7', 'Noei Natacha'),
(90, 'MyNumber', 'ให้นักศึกษาเขียน class MyNumber ที่สามารถคำนวณตัวเลขได้โดยมี \nmethod add เป็นการบวกตัวเลขจำนวนเต็ม 2 ตัว \nmethod subtract เป็นการลบตัวเลขจำนวนเต็ม 2 ตัว\nmethod multiply เป็นการคูณตัวเลขจำนวนเต็ม 2 ตัว', 1, 'public class MyNumber {\nint number;\n \n   public MyNumber() {\n      this.number = 0;\n   }\n\n   public MyNumber(int number) {\n      this.number = number;\n   }\n \n  \n   public int getNumber() {\n      return number;\n   }\n \n   public void setNumber(int number) {\n      this.number = number;\n   }\n \n  \n   public MyNumber add(MyNumber rhs) {\n      this.number += rhs.number;\n      return this;\n   }\n \n   public MyNumber div(MyNumber rhs) {\n      if (rhs.number == 0) throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      this.number /= rhs.number;\n      return this;\n   }\n}', 'MyNumber.Add(10,10) //return 20\nMyNumber.subtract(15,15) //return 0\nMyNumber.multiply(2,5) //return 10', 'Natacha Punlai'),
(91, 'Employee', 'เว็บแอปพลิเคชันจาวาโค้ดวอร์ ถูกพัฒนาขึ้นเพื่อช่วยเป็นแหล่งเก็บคลังโจทย์แบบฝึกหัดสำหรับอาจารย์ผู้สอนในรายวิชา การเขียนโปรแกรมในภาษาจาวา เป็นสื่อกลางสำหรับนักศึกษาและอาจารย์ผู้สอนในการทำโจทย์แบบฝึกหัด และดึงดูดนักศึกษาให้สนใจในการทำแบบฝึกหัดมากขึ้น\n', 5, 'import java.util.ArrayList;\nimport java.util.List;\npublic class Employee {\nprivate String name;\n    private int empId;\n    private int salary;\n     \n    public Employee(int id, String name, int sal){\n        this.empId = id;\n        this.name = name;\n        this.salary = sal;\n    }\n     \n    public boolean equals(Object obj){\n        Employee emp = (Employee) obj;\n        boolean status = false;\n        if(this.name.equalsIgnoreCase(emp.name)\n                && this.empId == emp.empId \n                && this.salary == emp.salary){\n            status = true;\n        }\n        return status;\n    }\n     \n    public static List<Employee> getEmpList(){\n        List<Employee> emps = new ArrayList<Employee>();\n        emps.add(new Employee(1, \"Nats\", 15000));\n        emps.add(new Employee(2, \"Kalid\", 25000));\n        emps.add(new Employee(3, \"Krish\", 5000));\n        return emps;\n    }\n     \n    public int hashCode(){\n        return this.empId;\n    }\n     \n    public String getName() {\n        return name;\n    }\n    public void setName(String name) {\n        this.name = name;\n    }\n    public int getEmpId() {\n        return empId;\n    }\n    public void setEmpId(int empId) {\n        this.empId = empId;\n    }\n    public int getSalary() {\n        return salary;\n    }\n    public void setSalary(int salary) {\n        this.salary = salary;\n    }\n\n}', 'expectedEmps[0] = new Employee(1, \"Nats\", 15000);\nexpectedEmps[1] = new Employee(2, \"Kalid\", 25000);\nexpectedEmps[2] = new Employee(3, \"Krish\", 5000);', 'Natacha Punlai'),
(92, 'MyUnit', 'จัดการคำตอบของนักศึกษา โดยการนำคำตอบของนักศึกษามาสร้างไฟล์ .java และนำชุด ทดสอบของอาจารย์ในข้อนั้นๆ มาสร้างไฟล์ .java นำทั้ง 2 ไฟล์ ใช้คำสั่ง คอมไพล์ (compile) ที่มาจากการติดตั้งเจดีเค (JDK) จะได้ไฟล์ .class ของ ทั้ง 2 ไฟล์ และใช้คำสั่งประมวลผลที่มากจากการติดตั้งเจดีเค จะได้ผลลัพธ์ออกมา จากนั้นทำการติดต่อกับฐานข้อมูล\n', 1, 'public class MyUnit {\n\n    public String concatenate(String one, String two){\n        return one + two;\n    }\n}', 'String result = myUnit.concatenate(\"one\", \"two\");', 'Natacha Punlai'),
(93, 'CalculatorTwo', 'ให้นักศึกษาเขียน class CalculatorTwo ที่สามาคำนวณตัวเลขจำนวนเต็ม 2 ตัว โดยมี\nmethod add เป็นการบวกตัวเลขจำนวนเต็ม 2 ตัว\nmethod sub เป็นการลบตัวเลขจำนวนเต็ม 2 ตัว\nmethod mul เป็นการคูณตัวเลขจำนวนเต็ม 2 ตัว\nmethod divInt เป็นการหารตัวเลขจำนวนเต็ม 2 ตัว\nmethod divReal เป็นการหารตัวเลขจำนวนจริง 2 ตัว', 3, 'public class CalculatorTwo {\npublic static int add(int number1, int number2) {\n      return number1 + number2;\n   }\n \n   public static int sub(int number1, int number2) {\n      return number1 - number2;\n   }\n \n   public static int mul(int number1, int number2) {\n      return number1 * number2;\n   }\n \n   \n   public static int divInt(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return number1 / number2;\n   }\n \n   \n   public static double divReal(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return (double) number1 / number2;\n   }\n}', 'CalculatorTwo.add(1, 2))  // return 3\nCalculatorTwo.sub(2, 1)) // return 1\nCalculatorTwo.divInt(9, 3))  // return 3\nCalculatorTwo.divReal(1, 3))  // return 0.333333', 'Natacha Punlai');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` char(10) COLLATE utf8mb4_bin NOT NULL,
  `student_pass` char(100) COLLATE utf8mb4_bin NOT NULL,
  `student_name` char(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `student_email` char(50) COLLATE utf8mb4_bin NOT NULL,
  `student_picture` char(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_pass`, `student_name`, `student_email`, `student_picture`) VALUES
('5909610301', '', 'กมลพัชร  ใจเพชร', 'boss_frozen@hotmail.com', ''),
('5909610302', '', 'กุสุมภ์ ดอกคำ', 'ddkusumdokkum@gmail.com', ''),
('5909610303', '', 'ขวัญสรวง ขวัญฟ้า', 'ddfai_111@gmail.com', ''),
('5909610304', '2b2b9aa20753c44da9c8d4cd34fe505fb476f333d2ebd9366bcfc0c17618ca23', 'ชยุตม์ ชัยคุณ', 'baewjaiboss@gmail.com', ''),
('5909610305', '', 'จรัสศรี ผุดผ่อง', 'putpoddng_jaratsee@gmail.com', ''),
('5909610306', '', 'จิรชยา มีชัยนาน', 'baam@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `submitsession`
--

CREATE TABLE `submitsession` (
  `submitsession_id` int(11) NOT NULL,
  `submitsession_code` text COLLATE utf8mb4_bin NOT NULL,
  `submitsession_time` time NOT NULL,
  `submitsession_copy_paste` char(5) COLLATE utf8mb4_bin NOT NULL,
  `submitsession_point` float NOT NULL,
  `submitsession_status` char(10) COLLATE utf8mb4_bin NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `submitsession`
--

INSERT INTO `submitsession` (`submitsession_id`, `submitsession_code`, `submitsession_time`, `submitsession_copy_paste`, `submitsession_point`, `submitsession_status`, `answer_id`) VALUES
(6, 'public class CalculatorOne {\npublic CalculatorOne() {\n    }\n   \n    public int add(int a, int b) {\n        return a + b\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', '00:00:28', 'No', 0, 'Submit', 3),
(7, 'public class CalculatorOne {\npublic CalculatorOne() {\n    }\n   \n    public int add(int a, int b) {\n        return a - b;\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', '00:00:55', 'No', 1.33, 'Submit', 3),
(8, 'public class CalculatorOne {\npublic CalculatorOne() {\n    }\n   \n    public int add(int a, int b) {\n        return a + b;\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', '00:01:17', 'No', 2, 'Submit', 3),
(9, 'public class CalculatorOne {\npublic CalculatorOne() {\n    }\n   \n    public int add(int a, int b) {\n        return a + b;\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', '00:01:47', 'Yes', 2, 'Submit', 3),
(10, 'public class CalculatorOne {\npublic CalculatorOne() {\n    }\n   \n    public int add(int a, int b) {\n        return a + b;\n//save\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', '00:02:08', 'Yes', 0, 'Save', 3),
(11, 'public class CalculatorTwo {\npublic static int add(int number1, int number2) {\n      return number1 + number2;\n   }\n \n   public static int sub(int number1, int number2) {\n      return number1 - number2\n   }\n \n   public static int mul(int number1, int number2) {\n      return number1 * number2;\n   }\n \n   \n   public static int divInt(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return number1 / number2;\n   }\n \n   \n   public static double divReal(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return (double) number1 / number2;\n   }\n}', '00:00:51', 'No', 0, 'Submit', 4),
(12, 'public class CalculatorTwo {\npublic static int add(int number1, int number2) {\n      return number1 + number2;\n   }\n \n   public static int sub(int number1, int number2) {\n      return number1 + number2;\n   }\n \n   public static int mul(int number1, int number2) {\n      return number1 * number2;\n   }\n \n   \n   public static int divInt(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return number1 / number2;\n   }\n \n   \n   public static double divReal(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return (double) number1 / number2;\n   }\n}', '00:01:26', 'No', 2.67, 'Submit', 4),
(13, 'public class CalculatorTwo {\npublic static int add(int number1, int number2) {\n      return number1 + number2;\n   }\n //save\n   public static int sub(int number1, int number2) {\n      return number1 + number2;\n   }\n \n   public static int mul(int number1, int number2) {\n      return number1 * number2;\n   }\n \n   \n   public static int divInt(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return number1 / number2;\n   }\n \n   \n   public static double divReal(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return (double) number1 / number2;\n   }\n}', '00:01:41', 'No', 0, 'Save', 4),
(14, 'public class CalculatorTwo {\npublic static int add(int number1, int number2) {\n      return number1 + number2;\n   }\n \n   public static int sub(int number1, int number2) {\n      return number1 - number2;\n   }\n \n   public static int mul(int number1, int number2) {\n      return number1 * number2;\n   }\n \n   \n   public static int divInt(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return number1 / number2;\n   }\n \n   \n   public static double divReal(int number1, int number2) {\n      if (number2 == 0) {\n         throw new IllegalArgumentException(\"Cannot divide by 0!\");\n      }\n      return (double) number1 / number2;\n   }\n}', '00:01:15', 'Yes', 3, 'Submit', 4),
(15, 'public class CalculatorOne {\npublic CalculatorOne() {}\n  \n   \n    public int add(int a, int b) {\n        return a + b;\n    }\n    \n    public int subtract(int a, int b) {\n       return a - b;\n    }\n    \n    public long multiply(int a, int b) {\n        return a * b;\n    }\n}', '00:00:05', 'No', 0, 'Submit', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`question_id`, `tag_id`) VALUES
(41, 13),
(41, 14),
(41, 15),
(42, 16),
(42, 17),
(42, 18),
(48, 33),
(48, 34),
(48, 35),
(48, 49),
(48, 50),
(56, 48),
(65, 91),
(65, 92),
(68, 95),
(68, 96),
(68, 97),
(68, 98),
(68, 130),
(68, 131),
(68, 132),
(68, 133),
(68, 138),
(68, 139),
(68, 140),
(68, 141),
(79, 116),
(80, 117),
(80, 118),
(80, 119),
(80, 120),
(82, 124),
(82, 125),
(82, 126),
(82, 127),
(90, 146),
(90, 147),
(90, 148),
(90, 149),
(91, 150),
(91, 151),
(92, 152),
(92, 153),
(93, 154),
(93, 155),
(93, 156);

-- --------------------------------------------------------

--
-- Table structure for table `taglist`
--

CREATE TABLE `taglist` (
  `tag_id` int(11) NOT NULL,
  `tag_tag` char(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `taglist`
--

INSERT INTO `taglist` (`tag_id`, `tag_tag`) VALUES
(117, 'if-else'),
(118, 'loop'),
(119, 'array'),
(120, 'number'),
(124, 'mathematics'),
(125, 'number'),
(126, 'fundamentals'),
(127, 'if-else'),
(130, 'if-else'),
(131, 'integer'),
(132, 'number'),
(133, 'algorithms'),
(138, 'if-else'),
(139, 'integer'),
(140, 'number'),
(141, 'algorithms'),
(146, 'if-else'),
(147, 'integer'),
(148, 'number'),
(149, 'algorithms'),
(150, 'array'),
(151, 'arraylist'),
(152, 'concate'),
(153, 'string'),
(154, 'mathematics'),
(155, 'number'),
(156, 'fundamentals');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_user` char(20) COLLATE utf8mb4_bin NOT NULL,
  `teacher_pass` char(100) COLLATE utf8mb4_bin NOT NULL,
  `teacher_email` char(50) COLLATE utf8mb4_bin NOT NULL,
  `teacher_picture` char(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_user`, `teacher_pass`, `teacher_email`, `teacher_picture`) VALUES
('Natacha', '508776ac911257cedccd87c62a09161d920f80db04a7444eb31b8fab0755e064', 'f2@gmail.com', ''),
('Natacha Punlai', '2b2b9aa20753c44da9c8d4cd34fe505fb476f333d2ebd9366bcfc0c17618ca23', 'punlainatacha@gmail.com', '209400799220200603_151525.jpg'),
('Noei Natacha', '2b2b9aa20753c44da9c8d4cd34fe505fb476f333d2ebd9366bcfc0c17618ca23', 'noeyza54.3@gmail.com', ''),
('Sukanya', '747d2a1f223061de3840b08b304b89eaac8d3534ce260d2dedc812620307ff33', 'baewjaiboss00000@gmail.com', ''),
('baam', 'a1cbba95b76c0613ba5ae444f2af80392c5c23872b83ba0608f5f1ee622f5617', 'baam@gmail.com', ''),
('baewjaiboss', '2b2b9aa20753c44da9c8d4cd34fe505fb476f333d2ebd9366bcfc0c17618ca23', 'baewjaibosserr@gmail.com', '48542280720200531_150947.png'),
('boss', '70c0c8c81e3dc6049b8efb20800b2c0fd0b94503a4a4350ce28426bed0951cc1', 'bjssssb@gmail.com', '144145730420200422_194152.png'),
('n', '508776ac911257cedccd87c62a09161d920f80db04a7444eb31b8fab0755e064', 'd@gmail.com', ''),
('pinkblossom', '2b2b9aa20753c44da9c8d4cd34fe505fb476f333d2ebd9366bcfc0c17618ca23', 'bjb1234@gmail.com', ''),
('test', 'e51b222cbc75075d1229ef7ad897734132f41e6201abe299b5ab34949d3b2203', 'eeeeeee@gmail.com', ''),
('สำเร็จ ไปได้ด้วยดี', '60b0d0293d007dfe8fd08c5591ff79cb64633275d4dd59ce7404ee4f2ccfe2ca', 'aaa@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `testcase`
--

CREATE TABLE `testcase` (
  `testcase_id` int(11) NOT NULL,
  `testcase_testcase` text COLLATE utf8mb4_bin NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `testcase`
--

INSERT INTO `testcase` (`testcase_id`, `testcase_testcase`, `question_id`) VALUES
(13, ' import static org.junit.Assert.*;\r\nimport org.junit.Test;\r\n \r\npublic class Calculator0Test {\r\n   @Test\r\n   public void testAddPass() {\r\n     \r\n      assertEquals(\"error in add()\",  3, Calculator0.add(1, 2));\r\n      assertEquals(\"error in add()\", -3, Calculator0.add(-1, -2));\r\n      assertEquals(\"error in add()\",  9, Calculator0.add(9, 0));\r\n   }\r\n \r\n   @Test\r\n   public void testAddFail() {\r\n      \r\n      assertNotEquals(\"error in add()\", 0, Calculator0.add(1, 2));\r\n   }\r\n \r\n   @Test\r\n   public void testSubPass() {\r\n      assertEquals(\"error in sub()\",  1, Calculator0.sub(2, 1));\r\n      assertEquals(\"error in sub()\", -1, Calculator0.sub(-2, -1));\r\n      assertEquals(\"error in sub()\",  0, Calculator0.sub(2, 2));\r\n   }\r\n \r\n   @Test\r\n   public void testSubFail() {\r\n      assertNotEquals(\"error in sub()\", 0, Calculator0.sub(2, 1));\r\n   }\r\n}', 41),
(16, 'import static org.junit.Assert.*;\r\nimport org.junit.Test;\r\nimport org.junit.After;   \r\nimport org.junit.Before; \r\npublic class DogTest {\r\n    Dog myDog;\r\n    @Before\r\n    public void setUp(){\r\n        System.out.println(\"This is run before\");\r\n        myDog = new Dog(\"Jimmy\", \"Beagle\");\r\n    }\r\n    @After\r\n    public void tearDown(){\r\n        System.out.println(\"This is run after\");\r\n    }\r\n    @Test\r\n    public void createNewDog(){\r\n        assertEquals(\"Error in creating a dog\", \"Jimmy\", myDog.getName());\r\n    }\r\n    @Test\r\n    public void feedDog(){\r\n        myDog.setWeight(5);\r\n        myDog.eat();\r\n        assertEquals(\"Error when eating\", 10, myDog.getWeight());\r\n    }\r\n}', 42),
(83, 'import static org.junit.Assert.assertEquals;  \nimport org.junit.After;  \nimport org.junit.AfterClass;  \nimport org.junit.Before;  \nimport org.junit.BeforeClass;  \nimport org.junit.Test;  \n  \npublic class Calculation3Test{  \n  \n    @BeforeClass  \n    public static void setUpBeforeClass() throws Exception {  \n        System.out.println(\"before class\");  \n    }  \n    @Before  \n    public void setUp() throws Exception {  \n        System.out.println(\"before\");  \n    }  \n  \n    @Test  \n    public void testFindMax(){  \n        System.out.println(\"test case find max\");  \n        assertEquals(4,Calculation3.findMax(new int[]{1,3,4,2}));  \n        assertEquals(-2,Calculation3.findMax(new int[]{-12,-3,-4,-2}));  \n    }  \n    @Test  \n    public void testCube(){  \n        System.out.println(\"test case cube\");  \n        assertEquals(27,Calculation3.cube(3));  \n    }  \n    @Test  \n    public void testReverseWord(){  \n        System.out.println(\"test case reverse word\");  \n        assertEquals(\"ym eman si nahk\",Calculation3.reverseWord(\"my name is khan\"));  \n    }  \n    @After  \n    public void tearDown() throws Exception {  \n        System.out.println(\"after\");  \n    }  \n  \n    @AfterClass  \n    public static void tearDownAfterClass() throws Exception {  \n        System.out.println(\"after class\");  \n    }  \n  \n}', 65),
(92, 'import static org.junit.Assert.*;\nimport org.junit.After;\nimport org.junit.Before;\nimport org.junit.Test;', 68),
(93, 'public class MyNumberTest {', 68),
(94, 'private MyNumber number1, number2; \n\n   @Before\n   public void setUp() throws Exception {\n      System.out.println(\"Run @Before\"); \n      number1 = new MyNumber(11);\n      number2 = new MyNumber(22);\n   }\n \n   @After\n   public void tearDown() throws Exception {\n      System.out.println(\"Run @After\"); \n   }\n \n   @Test\n   public void testGetterSetter() {\n      System.out.println(\"Run @Test testGetterSetter\"); \n      int value = 33;\n      number1.setNumber(value);\n      assertEquals(\"error in getter/setter\", value, number1.getNumber());\n   }\n \n   @Test\n   public void testAdd() {\n      System.out.println(\"Run @Test testAdd\"); \n      assertEquals(\"error in add()\", 33, number1.add(number2).getNumber());\n      assertEquals(\"error in add()\", 55, number1.add(number2).getNumber());\n   }\n \n   @Test\n   public void testDiv() {\n      System.out.println(\"Run @Test testDiv\"); \n      assertEquals(\"error in div()\", 2, number2.div(number1).getNumber());\n      assertEquals(\"error in div()\", 0, number2.div(number1).getNumber());\n   }\n \n   @Test(expected = IllegalArgumentException.class)\n   public void testDivByZero() {\n      System.out.println(\"Run @Test testDivByZero\"); \n      number2.setNumber(0);\n      number1.div(number2);\n   }', 68),
(95, '}', 68),
(152, 'import static org.junit.Assert.assertEquals;  \nimport org.junit.After;  \nimport org.junit.AfterClass;  \nimport org.junit.Before;  \nimport org.junit.BeforeClass;  \nimport org.junit.Test;', 80),
(153, 'public class CalculationTest {', 80),
(154, '@BeforeClass  \n    public static void setUpBeforeClass() throws Exception {  \n        System.out.println(\"before class\");  \n    }  \n    @Before  \n    public void setUp() throws Exception {  \n        System.out.println(\"before\");  \n    }  \n  \n    @Test  \n    public void testFindMaxOne(){  \n        System.out.println(\"test case find max\");  \n        assertEquals(-2,Calculation.findMax(new int[]{-12,-3,-4,-2}));  \n    }  \n\n    @Test  \n    public void testFindMaxTwo(){  \n        System.out.println(\"test case find max\");  \n        assertEquals(4,Calculation.findMax(new int[]{1,3,4,2}));  \n\n    }\n     \n    @After  \n    public void tearDown() throws Exception {  \n        System.out.println(\"after\");  \n    }  \n  \n    @AfterClass  \n    public static void tearDownAfterClass() throws Exception {  \n        System.out.println(\"after class\");  \n    }', 80),
(155, '}', 80),
(160, 'import org.junit.Test;\nimport org.junit.Assert;\nimport org.junit.Before;\nimport org.junit.After;', 82),
(161, 'public class CalculatorOneTest {', 82),
(162, 'private CalculatorOne objCalcUnderTest;\n    @Before\n    public void setUp() {\n        objCalcUnderTest = new CalculatorOne();\n    }\n    @Test\n    public void testAdd() {\n        int a = 15;\n        int b = 20;\n        int expectedResult = 35;\n        long result = objCalcUnderTest.add(a, b);\n        Assert.assertEquals(expectedResult, result);;\n    }\n    @Test\n    public void testSubtract() {\n        int a = 25;\n        int b = 20;\n        int expectedResult = 5;\n        long result = objCalcUnderTest.subtract(a, b);\n        Assert.assertEquals(expectedResult, result);;\n    }\n    @Test\n    public void testMultiply() {\n        int a = 10;\n        int b = 25;\n        long expectedResult = 250;\n        long result = objCalcUnderTest.multiply(a, b);\n        Assert.assertEquals(expectedResult, result);;\n    }\n    \n  @After\n    public void tearDown() {\n        objCalcUnderTest = null;\n    }', 82),
(163, '}', 82),
(164, '7', 82),
(165, 'public class CalculatorOneTest {', 82),
(166, '7', 82),
(167, '}', 82),
(172, 'import static org.junit.Assert.*;\nimport org.junit.After;\nimport org.junit.Before;\nimport org.junit.Test;', 68),
(173, 'public class MyNumberTest {', 68),
(174, 'private MyNumber number1, number2; \n \n   @Before\n   public void setUp() throws Exception {\n      System.out.println(\"Run @Before\"); \n      number1 = new MyNumber(11);\n      number2 = new MyNumber(22);\n   }\n \n   @After\n   public void tearDown() throws Exception {\n      System.out.println(\"Run @After\"); \n   }\n \n   @Test\n   public void testGetterSetter() {\n      System.out.println(\"Run @Test testGetterSetter\"); \n      int value = 33;\n      number1.setNumber(value);\n      assertEquals(\"error in getter/setter\", value, number1.getNumber());\n   }\n \n   @Test\n   public void testAdd() {\n      System.out.println(\"Run @Test testAdd\"); \n      assertEquals(\"error in add()\", 33, number1.add(number2).getNumber());\n      assertEquals(\"error in add()\", 55, number1.add(number2).getNumber());\n   }\n \n   @Test\n   public void testDiv() {\n      System.out.println(\"Run @Test testDiv\"); \n      assertEquals(\"error in div()\", 2, number2.div(number1).getNumber());\n      assertEquals(\"error in div()\", 0, number2.div(number1).getNumber());\n   }\n \n   @Test(expected = IllegalArgumentException.class)\n   public void testDivByZero() {\n      System.out.println(\"Run @Test testDivByZero\"); \n      number2.setNumber(0);\n      number1.div(number2);\n   }', 68),
(175, '}', 68),
(180, '5', 68),
(181, 'public class MyNumberTest {', 68),
(182, '5', 68),
(183, '}', 68),
(192, 'import static org.junit.Assert.*;\nimport org.junit.After;\nimport org.junit.Before;\nimport org.junit.Test;', 90),
(193, 'public class MyNumberTest {', 90),
(194, 'private MyNumber number1, number2; \n \n   @Before\n   public void setUp() throws Exception {\n      System.out.println(\"Run @Before\"); \n      number1 = new MyNumber(11);\n      number2 = new MyNumber(22);\n   }\n \n   @After\n   public void tearDown() throws Exception {\n      System.out.println(\"Run @After\"); \n   }\n \n   @Test\n   public void testGetterSetter() {\n      System.out.println(\"Run @Test testGetterSetter\"); \n      int value = 33;\n      number1.setNumber(value);\n      assertEquals(\"error in getter/setter\", value, number1.getNumber());\n   }\n \n   @Test\n   public void testAdd() {\n      System.out.println(\"Run @Test testAdd\"); \n      assertEquals(\"error in add()\", 33, number1.add(number2).getNumber());\n      assertEquals(\"error in add()\", 55, number1.add(number2).getNumber());\n   }\n \n   @Test\n   public void testDiv() {\n      System.out.println(\"Run @Test testDiv\"); \n      assertEquals(\"error in div()\", 2, number2.div(number1).getNumber());\n      assertEquals(\"error in div()\", 0, number2.div(number1).getNumber());\n   }\n \n   @Test(expected = IllegalArgumentException.class)\n   public void testDivByZero() {\n      System.out.println(\"Run @Test testDivByZero\"); \n      number2.setNumber(0);\n      number1.div(number2);\n   }', 90),
(195, '}', 90),
(196, 'import static org.junit.Assert.*;\nimport org.junit.Before;\nimport org.junit.Test;', 91),
(197, 'public class EmployeeTest {', 91),
(198, 'Object[] expectedEmps = new Object[3];\n     \n    @Before\n    public void initInputs(){\n        expectedEmps[0] = new Employee(1, \"Nats\", 15000);\n        expectedEmps[1] = new Employee(2, \"Kalid\", 25000);\n        expectedEmps[2] = new Employee(3, \"Krish\", 5000);\n    }\n     \n    @Test\n    public void compareEmployees(){\n       \n        Object[] testOutput = Employee.getEmpList().toArray();\n        assertArrayEquals(expectedEmps, testOutput);\n    }', 91),
(199, '}', 91),
(200, 'import org.junit.Test;\nimport static org.junit.Assert.*;', 92),
(201, 'public class MyUnitTest {', 92),
(202, '@Test\n    public void testConcatenate() {\n        MyUnit myUnit = new MyUnit();\n\n        String result = myUnit.concatenate(\"one\", \"two\");\n\n        assertEquals(\"onetwo\", result);\n\n    }', 92),
(203, '}', 92),
(204, 'import static org.junit.Assert.*;\nimport org.junit.Test;', 93),
(205, 'public class CalculatorTwoTest {', 93),
(206, '@Test\n   public void testAddPass() {\n     \n      assertEquals(\"error in add()\",  3, CalculatorTwo.add(1, 2));\n      assertEquals(\"error in add()\", -3, CalculatorTwo.add(-1, -2));\n      assertEquals(\"error in add()\",  9, CalculatorTwo.add(9, 0));\n   }\n \n   @Test\n   public void testAddFail() {\n      \n      assertNotEquals(\"error in add()\", 0, CalculatorTwo.add(1, 2));\n   }\n \n   @Test\n   public void testSubPass() {\n      assertEquals(\"error in sub()\",  1, CalculatorTwo.sub(2, 1));\n      assertEquals(\"error in sub()\", -1, CalculatorTwo.sub(-2, -1));\n      assertEquals(\"error in sub()\",  0, CalculatorTwo.sub(2, 2));\n   }\n \n   @Test\n   public void testSubFail() {\n      assertNotEquals(\"error in sub()\", 0, CalculatorTwo.sub(2, 1));\n   }\n\n@Test\n   public void testDivIntPass() {\n      assertEquals(\"error in divInt()\", 3, CalculatorTwo.divInt(9, 3));\n      assertEquals(\"error in divInt()\", 0, CalculatorTwo.divInt(1, 9));\n   }\n \n   @Test\n   public void testDivIntFail() {\n      assertNotEquals(\"error in divInt()\", 1, CalculatorTwo.divInt(9, 3));\n   }\n \n   @Test(expected = IllegalArgumentException.class)\n   public void testDivIntByZero() {\n      CalculatorTwo.divInt(9, 0); // expect an IllegalArgumentException\n   }\n \n   @Test\n   public void testDivRealPass() {\n      assertEquals(\"error in divInt()\", 0.333333, CalculatorTwo.divReal(1, 3), 1e-6);\n      assertEquals(\"error in divInt()\", 0.111111, CalculatorTwo.divReal(1, 9), 1e-6);\n   }\n \n   @Test(expected = IllegalArgumentException.class)\n   public void testDivRealByZero() {\n      CalculatorTwo.divReal(9, 0); // expect an IllegalArgumentException\n   }', 93),
(207, '}', 93);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `tacher_user` (`teacher_user`);

--
-- Indexes for table `coursequestion`
--
ALTER TABLE `coursequestion`
  ADD PRIMARY KEY (`course_id`,`question_id`);

--
-- Indexes for table `coursestudent`
--
ALTER TABLE `coursestudent`
  ADD PRIMARY KEY (`course_id`,`student_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `submitsession`
--
ALTER TABLE `submitsession`
  ADD PRIMARY KEY (`submitsession_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`question_id`,`tag_id`);

--
-- Indexes for table `taglist`
--
ALTER TABLE `taglist`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_user`);

--
-- Indexes for table `testcase`
--
ALTER TABLE `testcase`
  ADD PRIMARY KEY (`testcase_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `submitsession`
--
ALTER TABLE `submitsession`
  MODIFY `submitsession_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `taglist`
--
ALTER TABLE `taglist`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `testcase`
--
ALTER TABLE `testcase`
  MODIFY `testcase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `tacher_user` FOREIGN KEY (`teacher_user`) REFERENCES `teacher` (`teacher_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `testcase`
--
ALTER TABLE `testcase`
  ADD CONSTRAINT `testcase_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
