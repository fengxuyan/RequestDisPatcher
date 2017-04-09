package com.carrot.jn;

import java.io.File;
import java.io.IOException;
import java.util.UUID;

import javax.servlet.http.HttpServletRequest;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.multipart.MultipartHttpServletRequest;

import com.alibaba.fastjson.JSONObject;


@Controller
@RequestMapping("/request")
public class RequestDisPatcher 
{
    @RequestMapping(value ="/dispatcher.do",method=RequestMethod.POST)
    @ResponseBody
    public JSONObject dispatcher(HttpServletRequest req)
    {
    	String url = req.getParameter("url");
    	String params = req.getParameter("params");
    	return new HttpUtil().httpRequest(url, "POST", params);
        
    }
    
    @RequestMapping(value ="/upload.do",method=RequestMethod.POST)
    @ResponseBody
    public JSONObject upload(HttpServletRequest req,MultipartFile heads){
    	
    	String url = req.getParameter("url");
    	String param = req.getParameter("params");
    	String token = req.getParameter("token");
    	String web_image = null;
    	
    	if(heads!=null){
    		String random = String.valueOf(UUID.randomUUID().hashCode()).substring(2,6);
    		JSONObject json = new JSONObject();
        	json = new HttpUtil().httpRequest("http://101.37.100.209:9001/login/getUserIdByToken", "POST", token);
        	String path = "/root/tomcat/apache-tomcat-7.0.77/head/"+json.get("Data")+random+".png";
        	String path1 = "http://101.37.100.209:8080/head/"+json.get("Data")+random+".png";
    		/*json = new HttpUtil().httpRequest("http://127.0.0.1:9001/login/getUserIdByToken", "POST", token);
        	String path = "D:\\Tomcat\\webapps\\head"+json.get("Data")+random+".png";
        	String path1 = "http://127.0.0.1:8080/head/"+json.get("Data")+random+".png";*/
    		web_image = path1;
        	try {
				heads.transferTo(new File(path));
			} catch (Exception e) {
				e.printStackTrace();
				JSONObject json1 = new JSONObject();
				json1.put("Code", 0);
				json1.put("Message", "Error when save Data");
				json1.put("Data", null);
				return json1;
			}
    	}
    	
    	//参数拼接 ...&...&...&token=token&web_image=web_image
    	String params = new StringBuffer(param).append("&token="+token).append("&web_image="+web_image).toString();
    	
    	return new HttpUtil().httpRequest(url, "POST", params);
    	
    }
    
}
