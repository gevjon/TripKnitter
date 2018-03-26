var objrs ="<?php echo $result;?>";
// 获取字段数目
var fdCount = objrs.Fields.Count - 1;
// 检查是否有记录 
if (!objrs.EOF)
{
    document.write("<table border=1><tr>");   
  // 显示数据库的字段名称
    for (var i=0; i <= fdCount; i++)
        document.write("<td><b>" + objrs.Fields(i).Name + "</b></td>");
    document.write("</tr>");
  // 显示数据库内容
    while (!objrs.EOF){
        document.write("<tr>");     
    // 显示每笔记录的字段
        for (i=0; i <= fdCount; i++)
            document.write("<td valign='top'>" + objrs.Fields(i).Value + "</td>");
        document.write("</tr>");
        objrs.moveNext();  // 移到下一笔记录
    }
    document.write("</table>"); 
}
else 
    document.write("No such record!<br/>");
objrs.Close();        // 关闭记录集合
objdbConn.Close();    // 关闭数据库链接

