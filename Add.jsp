<%@page import="java.sql.Statement"%>
<%@page import="javax.imageio.ImageIO"%>
<%@page import="java.awt.image.BufferedImage"%>
<%@page import="sun.misc.BASE64Encoder"%>
<%@page import="java.lang.NullPointerException"%>
<%@page import="java.io.InputStream"%>
<%@page import="java.io.ByteArrayOutputStream"%>
<%@page import="javabeans.Car"%>
<%@page import="java.util.*"%>
<%@page import="com.Request"%>
<%@page import="com.Service"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Blob"%>

<%@page language="java" contentType="text/html" pageEncoding="UTF-8"%>

                                        <%
                                        String model=request.getParameter("model");
                                        String seating_capacity=request.getParameter("seating_capacity");
                                        String luggage_capacity=request.getParameter("luggage_capacity");
                                        String aircon=request.getParameter("aircon");                                       
                                        String regno=request.getParameter("regno");
                                        String price=request.getParameter("price");
                                        String photo=request.getParameter("photo");
                                        String transmission=request.getParameter("transmission");
                                        String location=request.getParameter("location");
                                        try
                                        {
                                        Class.forName("com.mysql.jdbc.Driver");
                                        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "");
                                         Statement st=conn.createStatement();

                                        int i=st.executeUpdate("insert into vehicles(model,seating_capacity,luggage_capacity,air_conditioned,transmission,regno,daily_rate,picture,pickup_location)values('"+model+"','"+seating_capacity+"','"+luggage_capacity+"','"+aircon+"','"+transmission+"','"+regno+"','"+price+"','"+photo+"','"+location+"')");
                                        out.println("Data is successfully inserted!");
                                        }
                                        catch(Exception e)
                                        {
                                        System.out.print(e);
                                        e.printStackTrace();
                                        }
                                        %>