
package it.isharedoc.schemas.instance;

import java.net.MalformedURLException;
import java.net.URL;
import javax.xml.namespace.QName;
import javax.xml.ws.Service;
import javax.xml.ws.WebEndpoint;
import javax.xml.ws.WebServiceClient;
import javax.xml.ws.WebServiceException;
import javax.xml.ws.WebServiceFeature;


/**
 * This class was generated by the JAX-WS RI.
 * JAX-WS RI 2.2.4-b01
 * Generated source version: 2.2
 * 
 */
@WebServiceClient(name = "InstancePortService", targetNamespace = "http://www.isharedoc.it/schemas/instance", wsdlLocation = "https://democorepa.grupposistematica.it/isharedoc/webservices/webserviceInstance.wsdl")
public class InstancePortService
    extends Service
{

    private final static URL INSTANCEPORTSERVICE_WSDL_LOCATION;
    private final static WebServiceException INSTANCEPORTSERVICE_EXCEPTION;
    private final static QName INSTANCEPORTSERVICE_QNAME = new QName("http://www.isharedoc.it/schemas/instance", "InstancePortService");

    static {
        URL url = null;
        WebServiceException e = null;
        try {
            url = new URL("https://democorepa.grupposistematica.it/isharedoc/webservices/webserviceInstance.wsdl");
        } catch (MalformedURLException ex) {
            e = new WebServiceException(ex);
        }
        INSTANCEPORTSERVICE_WSDL_LOCATION = url;
        INSTANCEPORTSERVICE_EXCEPTION = e;
    }

    public InstancePortService() {
        super(__getWsdlLocation(), INSTANCEPORTSERVICE_QNAME);
    }

    public InstancePortService(WebServiceFeature... features) {
        super(__getWsdlLocation(), INSTANCEPORTSERVICE_QNAME, features);
    }

    public InstancePortService(URL wsdlLocation) {
        super(wsdlLocation, INSTANCEPORTSERVICE_QNAME);
    }

    public InstancePortService(URL wsdlLocation, WebServiceFeature... features) {
        super(wsdlLocation, INSTANCEPORTSERVICE_QNAME, features);
    }

    public InstancePortService(URL wsdlLocation, QName serviceName) {
        super(wsdlLocation, serviceName);
    }

    public InstancePortService(URL wsdlLocation, QName serviceName, WebServiceFeature... features) {
        super(wsdlLocation, serviceName, features);
    }

    /**
     * 
     * @return
     *     returns InstancePort
     */
    @WebEndpoint(name = "InstancePortSoap11")
    public InstancePort getInstancePortSoap11() {
        return super.getPort(new QName("http://www.isharedoc.it/schemas/instance", "InstancePortSoap11"), InstancePort.class);
    }

    /**
     * 
     * @param features
     *     A list of {@link javax.xml.ws.WebServiceFeature} to configure on the proxy.  Supported features not in the <code>features</code> parameter will have their default values.
     * @return
     *     returns InstancePort
     */
    @WebEndpoint(name = "InstancePortSoap11")
    public InstancePort getInstancePortSoap11(WebServiceFeature... features) {
        return super.getPort(new QName("http://www.isharedoc.it/schemas/instance", "InstancePortSoap11"), InstancePort.class, features);
    }

    private static URL __getWsdlLocation() {
        if (INSTANCEPORTSERVICE_EXCEPTION!= null) {
            throw INSTANCEPORTSERVICE_EXCEPTION;
        }
        return INSTANCEPORTSERVICE_WSDL_LOCATION;
    }

}
