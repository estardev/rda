import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Random;
import java.util.Set;
import java.util.TreeSet;
import javax.xml.namespace.QName;
import javax.xml.soap.*;
import javax.xml.ws.handler.MessageContext;
import javax.xml.ws.handler.soap.SOAPHandler;
import javax.xml.ws.handler.soap.SOAPMessageContext;

import sun.misc.BASE64Encoder;

public class WSSUsernameTokenSecurityHandler implements SOAPHandler<SOAPMessageContext> {
    private String login;
    private String pwd;
    public WSSUsernameTokenSecurityHandler(String login, String pwd) {
    	this.login = login;
    	this.pwd = pwd;
    }
    @Override
    public boolean handleMessage(SOAPMessageContext context) {
        Boolean outboundProperty =
                (Boolean) context.get(MessageContext.MESSAGE_OUTBOUND_PROPERTY);
        if (outboundProperty.booleanValue()) {
            try {
            	String timestamp = generateTimestamp();
            	String password = pwd;
            	String user = login;
            	String nonce = generateNonce();

            	SOAPEnvelope envelope = context.getMessage().getSOAPPart().getEnvelope();
            	SOAPHeader header = envelope.addHeader();

            	SOAPElement security =
            	header.addChildElement("Security", "wsse", "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd");


            	SOAPElement usernameToken =
            	security.addChildElement("UsernameToken", "wsse");


            	SOAPElement username =
            	usernameToken.addChildElement("Username", "wsse");
            	username.addTextNode(user);

            	SOAPElement pwd =
            	usernameToken.addChildElement("Password", "wsse");
            	pwd.setAttribute("Type", "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText");
            	pwd.addTextNode(password);

            	SOAPElement nonceElement =
            	usernameToken.addChildElement("Nonce", "wsse");
            	nonceElement.addTextNode(base64encode(hexEncode(nonce).getBytes()));

            	SOAPElement created = usernameToken.addChildElement("Created", "wsu", "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd");
            	created.addTextNode(timestamp);
            } catch (Exception e) {
                e.printStackTrace();
            }
        } else {
            // inbound
        }
        return true;
    }
    @Override
    public Set<QName> getHeaders() {
        return new TreeSet<QName>();
    }
    @Override
    public boolean handleFault(SOAPMessageContext context) {
        return false;
    }
    @Override
    public void close(MessageContext context) {
        //
    }
    
    private String hexEncode(String in) { 
    	StringBuilder sb = new StringBuilder(""); 
    	for (int i = 0; i < (in.length() - 2) + 1; i = i + 2)
    	{
    		int c = Integer.parseInt(in.substring(i, i + 2), 16);
    		char chr = (char) c; 
    			sb.append(chr); 
    	} 
    	return sb.toString();
    }
    public String digestPassword(String timestamp, String nonce, String password) {
    	try{ 
    		String beforeEncryption = nonce + timestamp + password;
    		byte[] digest = digest(beforeEncryption);
    		return base64encode(digest);
    	}
    	catch (Exception uee) {
    		throw new RuntimeException(uee); 
    	} 
    }
	private String base64encode(byte[] digest) {
		BASE64Encoder encoder = new BASE64Encoder();
		return encoder.encode(digest);
    }
    private byte[] digest(String beforeEncryption) throws NoSuchAlgorithmException, UnsupportedEncodingException {
    	MessageDigest SHA1 = MessageDigest.getInstance("SHA1"); 
    	SHA1.reset(); 
    	SHA1.update(beforeEncryption.getBytes("UTF-8")); 
    	return SHA1.digest(); 
    }
    private String generateTimestamp() {
    	SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss'Z'"); 
    	return sdf.format(new Date());
    }
    private String generateNonce() {
    	Random generator = new Random(); 
    	return String.valueOf(generator.nextInt(999999999)); 
    }
}