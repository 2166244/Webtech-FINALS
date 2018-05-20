<%-- 
    Document   : show-transaction
    Created on : May 20, 2018, 5:10:24 AM
    Author     : Denrich
--%>

<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Statement"%>
<%@page import="java.sql.Connection"%>
<%
String id=request.getParameter("id");
String name=request.getParameter("name");
String amount=request.getParameter("amount");
String form_date=request.getParameter("form_date");
String to_date=request.getParameter("to_date");
String date_time=request.getParameter("date_time");
String driver = "com.mysql.jdbc.Driver";
String connectionUrl = "jdbc:mysql://localhost:3306/";
String database = "rental";
String userid = "root";
String password = "";
try {
Class.forName(driver);
} catch (ClassNotFoundException e) {
e.printStackTrace();
}
Connection connection = null;
Statement statement = null;
ResultSet resultSet = null;
%>
<!DOCTYPE html>
<html>
<body>
<h1>Transaction History</h1>
<table border="1">
<tr>
<td>Id</td>
<td>Name</td>
<td>Amount</td>
<td>Date_Time</td>
</tr>
<%
try{
connection = DriverManager.getConnection(connectionUrl+database, userid, password);
statement=connection.createStatement();
String sql ="select * from transaction where date_time between '"+form_date+"' and '"+to_date+"'";
resultSet = statement.executeQuery(sql);
while(resultSet.next())
{
%>
<tr>
<td><%=resultSet.getString("id") %></td>
<td><%=resultSet.getString("name") %></td>
<td><%=resultSet.getString("amount") %></td>
<td><%=resultSet.getString("date_time") %></td>
</tr>
<%
}
connection.close();
} catch (Exception e) {
e.printStackTrace();
}
%>
</table>
</body>
</html>