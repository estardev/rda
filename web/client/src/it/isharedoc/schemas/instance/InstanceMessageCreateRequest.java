
package it.isharedoc.schemas.instance;

import java.math.BigDecimal;
import java.math.BigInteger;
import java.util.ArrayList;
import java.util.List;
import javax.activation.DataHandler;
import javax.xml.bind.JAXBElement;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlElementRef;
import javax.xml.bind.annotation.XmlMimeType;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlType;
import javax.xml.datatype.XMLGregorianCalendar;


/**
 * <p>Java class for anonymous complex type.
 * 
 * <p>The following schema fragment specifies the expected content contained within this class.
 * 
 * <pre>
 * &lt;complexType>
 *   &lt;complexContent>
 *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *       &lt;sequence>
 *         &lt;element name="partitionId" type="{http://www.w3.org/2001/XMLSchema}integer"/>
 *         &lt;element name="storyboardCode" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *         &lt;element name="messageBoxId" type="{http://www.w3.org/2001/XMLSchema}integer"/>
 *         &lt;element name="metaViewName" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="direction" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *         &lt;element name="contacts" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="contact" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="referenceType" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;choice>
 *                               &lt;element name="referenceCode" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                               &lt;element name="externalId" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;/choice>
 *                             &lt;element name="info1" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="info2" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="info3" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                           &lt;/sequence>
 *                         &lt;/restriction>
 *                       &lt;/complexContent>
 *                     &lt;/complexType>
 *                   &lt;/element>
 *                 &lt;/sequence>
 *               &lt;/restriction>
 *             &lt;/complexContent>
 *           &lt;/complexType>
 *         &lt;/element>
 *         &lt;element name="subject" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="body" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="note" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="tags" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="topics" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="topic" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="path" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                           &lt;/sequence>
 *                         &lt;/restriction>
 *                       &lt;/complexContent>
 *                     &lt;/complexType>
 *                   &lt;/element>
 *                 &lt;/sequence>
 *               &lt;/restriction>
 *             &lt;/complexContent>
 *           &lt;/complexType>
 *         &lt;/element>
 *         &lt;element name="extAppIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="extAppIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *         &lt;element name="variables" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="variable" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="key" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;choice>
 *                               &lt;element name="valueString" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                               &lt;element name="valueInteger" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
 *                               &lt;element name="valueDecimal" type="{http://www.w3.org/2001/XMLSchema}decimal" minOccurs="0"/>
 *                               &lt;element name="valueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *                               &lt;element name="valueBoolean" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
 *                             &lt;/choice>
 *                           &lt;/sequence>
 *                         &lt;/restriction>
 *                       &lt;/complexContent>
 *                     &lt;/complexType>
 *                   &lt;/element>
 *                 &lt;/sequence>
 *               &lt;/restriction>
 *             &lt;/complexContent>
 *           &lt;/complexType>
 *         &lt;/element>
 *         &lt;element name="attachments" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="attachment" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="fileset" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="filename" type="{http://www.w3.org/2001/XMLSchema}string"/>
 *                             &lt;element name="contentType" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="data" type="{http://www.w3.org/2001/XMLSchema}base64Binary"/>
 *                           &lt;/sequence>
 *                         &lt;/restriction>
 *                       &lt;/complexContent>
 *                     &lt;/complexType>
 *                   &lt;/element>
 *                 &lt;/sequence>
 *               &lt;/restriction>
 *             &lt;/complexContent>
 *           &lt;/complexType>
 *         &lt;/element>
 *         &lt;element name="references" minOccurs="0">
 *           &lt;complexType>
 *             &lt;complexContent>
 *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                 &lt;sequence>
 *                   &lt;element name="reference" maxOccurs="unbounded" minOccurs="0">
 *                     &lt;complexType>
 *                       &lt;complexContent>
 *                         &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
 *                           &lt;sequence>
 *                             &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
 *                             &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *                             &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *                           &lt;/sequence>
 *                         &lt;/restriction>
 *                       &lt;/complexContent>
 *                     &lt;/complexType>
 *                   &lt;/element>
 *                 &lt;/sequence>
 *               &lt;/restriction>
 *             &lt;/complexContent>
 *           &lt;/complexType>
 *         &lt;/element>
 *         &lt;element name="startWorkflow" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
 *         &lt;element name="instanceOperation" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
 *         &lt;element name="scheduledSendDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
 *       &lt;/sequence>
 *     &lt;/restriction>
 *   &lt;/complexContent>
 * &lt;/complexType>
 * </pre>
 * 
 * 
 */
@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {
    "partitionId",
    "storyboardCode",
    "messageBoxId",
    "metaViewName",
    "direction",
    "contacts",
    "subject",
    "body",
    "note",
    "tags",
    "topics",
    "extAppIdentifier",
    "extAppIdentifierDate",
    "variables",
    "attachments",
    "references",
    "startWorkflow",
    "instanceOperation",
    "scheduledSendDate"
})
@XmlRootElement(name = "InstanceMessageCreateRequest")
public class InstanceMessageCreateRequest {

    @XmlElement(required = true)
    protected BigInteger partitionId;
    @XmlElement(required = true)
    protected String storyboardCode;
    @XmlElement(required = true)
    protected BigInteger messageBoxId;
    @XmlElementRef(name = "metaViewName", type = JAXBElement.class, required = false)
    protected JAXBElement<String> metaViewName;
    @XmlElement(required = true)
    protected String direction;
    @XmlElementRef(name = "contacts", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageCreateRequest.Contacts> contacts;
    @XmlElementRef(name = "subject", type = JAXBElement.class, required = false)
    protected JAXBElement<String> subject;
    @XmlElementRef(name = "body", type = JAXBElement.class, required = false)
    protected JAXBElement<String> body;
    @XmlElementRef(name = "note", type = JAXBElement.class, required = false)
    protected JAXBElement<String> note;
    @XmlElementRef(name = "tags", type = JAXBElement.class, required = false)
    protected JAXBElement<String> tags;
    @XmlElementRef(name = "topics", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageCreateRequest.Topics> topics;
    @XmlElementRef(name = "extAppIdentifier", type = JAXBElement.class, required = false)
    protected JAXBElement<String> extAppIdentifier;
    @XmlElementRef(name = "extAppIdentifierDate", type = JAXBElement.class, required = false)
    protected JAXBElement<XMLGregorianCalendar> extAppIdentifierDate;
    @XmlElementRef(name = "variables", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageCreateRequest.Variables> variables;
    @XmlElementRef(name = "attachments", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageCreateRequest.Attachments> attachments;
    @XmlElementRef(name = "references", type = JAXBElement.class, required = false)
    protected JAXBElement<InstanceMessageCreateRequest.References> references;
    @XmlElementRef(name = "startWorkflow", type = JAXBElement.class, required = false)
    protected JAXBElement<Boolean> startWorkflow;
    @XmlElementRef(name = "instanceOperation", type = JAXBElement.class, required = false)
    protected JAXBElement<String> instanceOperation;
    @XmlElementRef(name = "scheduledSendDate", type = JAXBElement.class, required = false)
    protected JAXBElement<XMLGregorianCalendar> scheduledSendDate;

    /**
     * Gets the value of the partitionId property.
     * 
     * @return
     *     possible object is
     *     {@link BigInteger }
     *     
     */
    public BigInteger getPartitionId() {
        return partitionId;
    }

    /**
     * Sets the value of the partitionId property.
     * 
     * @param value
     *     allowed object is
     *     {@link BigInteger }
     *     
     */
    public void setPartitionId(BigInteger value) {
        this.partitionId = value;
    }

    /**
     * Gets the value of the storyboardCode property.
     * 
     * @return
     *     possible object is
     *     {@link String }
     *     
     */
    public String getStoryboardCode() {
        return storyboardCode;
    }

    /**
     * Sets the value of the storyboardCode property.
     * 
     * @param value
     *     allowed object is
     *     {@link String }
     *     
     */
    public void setStoryboardCode(String value) {
        this.storyboardCode = value;
    }

    /**
     * Gets the value of the messageBoxId property.
     * 
     * @return
     *     possible object is
     *     {@link BigInteger }
     *     
     */
    public BigInteger getMessageBoxId() {
        return messageBoxId;
    }

    /**
     * Sets the value of the messageBoxId property.
     * 
     * @param value
     *     allowed object is
     *     {@link BigInteger }
     *     
     */
    public void setMessageBoxId(BigInteger value) {
        this.messageBoxId = value;
    }

    /**
     * Gets the value of the metaViewName property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getMetaViewName() {
        return metaViewName;
    }

    /**
     * Sets the value of the metaViewName property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setMetaViewName(JAXBElement<String> value) {
        this.metaViewName = value;
    }

    /**
     * Gets the value of the direction property.
     * 
     * @return
     *     possible object is
     *     {@link String }
     *     
     */
    public String getDirection() {
        return direction;
    }

    /**
     * Sets the value of the direction property.
     * 
     * @param value
     *     allowed object is
     *     {@link String }
     *     
     */
    public void setDirection(String value) {
        this.direction = value;
    }

    /**
     * Gets the value of the contacts property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Contacts }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageCreateRequest.Contacts> getContacts() {
        return contacts;
    }

    /**
     * Sets the value of the contacts property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Contacts }{@code >}
     *     
     */
    public void setContacts(JAXBElement<InstanceMessageCreateRequest.Contacts> value) {
        this.contacts = value;
    }

    /**
     * Gets the value of the subject property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getSubject() {
        return subject;
    }

    /**
     * Sets the value of the subject property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setSubject(JAXBElement<String> value) {
        this.subject = value;
    }

    /**
     * Gets the value of the body property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getBody() {
        return body;
    }

    /**
     * Sets the value of the body property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setBody(JAXBElement<String> value) {
        this.body = value;
    }

    /**
     * Gets the value of the note property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getNote() {
        return note;
    }

    /**
     * Sets the value of the note property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setNote(JAXBElement<String> value) {
        this.note = value;
    }

    /**
     * Gets the value of the tags property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getTags() {
        return tags;
    }

    /**
     * Sets the value of the tags property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setTags(JAXBElement<String> value) {
        this.tags = value;
    }

    /**
     * Gets the value of the topics property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Topics }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageCreateRequest.Topics> getTopics() {
        return topics;
    }

    /**
     * Sets the value of the topics property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Topics }{@code >}
     *     
     */
    public void setTopics(JAXBElement<InstanceMessageCreateRequest.Topics> value) {
        this.topics = value;
    }

    /**
     * Gets the value of the extAppIdentifier property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getExtAppIdentifier() {
        return extAppIdentifier;
    }

    /**
     * Sets the value of the extAppIdentifier property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setExtAppIdentifier(JAXBElement<String> value) {
        this.extAppIdentifier = value;
    }

    /**
     * Gets the value of the extAppIdentifierDate property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public JAXBElement<XMLGregorianCalendar> getExtAppIdentifierDate() {
        return extAppIdentifierDate;
    }

    /**
     * Sets the value of the extAppIdentifierDate property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public void setExtAppIdentifierDate(JAXBElement<XMLGregorianCalendar> value) {
        this.extAppIdentifierDate = value;
    }

    /**
     * Gets the value of the variables property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Variables }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageCreateRequest.Variables> getVariables() {
        return variables;
    }

    /**
     * Sets the value of the variables property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Variables }{@code >}
     *     
     */
    public void setVariables(JAXBElement<InstanceMessageCreateRequest.Variables> value) {
        this.variables = value;
    }

    /**
     * Gets the value of the attachments property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Attachments }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageCreateRequest.Attachments> getAttachments() {
        return attachments;
    }

    /**
     * Sets the value of the attachments property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.Attachments }{@code >}
     *     
     */
    public void setAttachments(JAXBElement<InstanceMessageCreateRequest.Attachments> value) {
        this.attachments = value;
    }

    /**
     * Gets the value of the references property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.References }{@code >}
     *     
     */
    public JAXBElement<InstanceMessageCreateRequest.References> getReferences() {
        return references;
    }

    /**
     * Sets the value of the references property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link InstanceMessageCreateRequest.References }{@code >}
     *     
     */
    public void setReferences(JAXBElement<InstanceMessageCreateRequest.References> value) {
        this.references = value;
    }

    /**
     * Gets the value of the startWorkflow property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link Boolean }{@code >}
     *     
     */
    public JAXBElement<Boolean> getStartWorkflow() {
        return startWorkflow;
    }

    /**
     * Sets the value of the startWorkflow property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link Boolean }{@code >}
     *     
     */
    public void setStartWorkflow(JAXBElement<Boolean> value) {
        this.startWorkflow = value;
    }

    /**
     * Gets the value of the instanceOperation property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public JAXBElement<String> getInstanceOperation() {
        return instanceOperation;
    }

    /**
     * Sets the value of the instanceOperation property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link String }{@code >}
     *     
     */
    public void setInstanceOperation(JAXBElement<String> value) {
        this.instanceOperation = value;
    }

    /**
     * Gets the value of the scheduledSendDate property.
     * 
     * @return
     *     possible object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public JAXBElement<XMLGregorianCalendar> getScheduledSendDate() {
        return scheduledSendDate;
    }

    /**
     * Sets the value of the scheduledSendDate property.
     * 
     * @param value
     *     allowed object is
     *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
     *     
     */
    public void setScheduledSendDate(JAXBElement<XMLGregorianCalendar> value) {
        this.scheduledSendDate = value;
    }


    /**
     * <p>Java class for anonymous complex type.
     * 
     * <p>The following schema fragment specifies the expected content contained within this class.
     * 
     * <pre>
     * &lt;complexType>
     *   &lt;complexContent>
     *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *       &lt;sequence>
     *         &lt;element name="attachment" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="fileset" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="filename" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="contentType" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="data" type="{http://www.w3.org/2001/XMLSchema}base64Binary"/>
     *                 &lt;/sequence>
     *               &lt;/restriction>
     *             &lt;/complexContent>
     *           &lt;/complexType>
     *         &lt;/element>
     *       &lt;/sequence>
     *     &lt;/restriction>
     *   &lt;/complexContent>
     * &lt;/complexType>
     * </pre>
     * 
     * 
     */
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "", propOrder = {
        "attachment"
    })
    public static class Attachments {

        @XmlElement(nillable = true)
        protected List<InstanceMessageCreateRequest.Attachments.Attachment> attachment;

        /**
         * Gets the value of the attachment property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the attachment property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getAttachment().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageCreateRequest.Attachments.Attachment }
         * 
         * 
         */
        public List<InstanceMessageCreateRequest.Attachments.Attachment> getAttachment() {
            if (attachment == null) {
                attachment = new ArrayList<InstanceMessageCreateRequest.Attachments.Attachment>();
            }
            return this.attachment;
        }


        /**
         * <p>Java class for anonymous complex type.
         * 
         * <p>The following schema fragment specifies the expected content contained within this class.
         * 
         * <pre>
         * &lt;complexType>
         *   &lt;complexContent>
         *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *       &lt;sequence>
         *         &lt;element name="fileset" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="filename" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="contentType" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="data" type="{http://www.w3.org/2001/XMLSchema}base64Binary"/>
         *       &lt;/sequence>
         *     &lt;/restriction>
         *   &lt;/complexContent>
         * &lt;/complexType>
         * </pre>
         * 
         * 
         */
        @XmlAccessorType(XmlAccessType.FIELD)
        @XmlType(name = "", propOrder = {
            "fileset",
            "filename",
            "contentType",
            "data"
        })
        public static class Attachment {

            @XmlElement(required = true)
            protected String fileset;
            @XmlElement(required = true)
            protected String filename;
            @XmlElementRef(name = "contentType", type = JAXBElement.class, required = false)
            protected JAXBElement<String> contentType;
            @XmlElement(required = true)
            @XmlMimeType("application/octet-stream")
            protected DataHandler data;

            /**
             * Gets the value of the fileset property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getFileset() {
                return fileset;
            }

            /**
             * Sets the value of the fileset property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setFileset(String value) {
                this.fileset = value;
            }

            /**
             * Gets the value of the filename property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getFilename() {
                return filename;
            }

            /**
             * Sets the value of the filename property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setFilename(String value) {
                this.filename = value;
            }

            /**
             * Gets the value of the contentType property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getContentType() {
                return contentType;
            }

            /**
             * Sets the value of the contentType property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setContentType(JAXBElement<String> value) {
                this.contentType = value;
            }

            /**
             * Gets the value of the data property.
             * 
             * @return
             *     possible object is
             *     {@link DataHandler }
             *     
             */
            public DataHandler getData() {
                return data;
            }

            /**
             * Sets the value of the data property.
             * 
             * @param value
             *     allowed object is
             *     {@link DataHandler }
             *     
             */
            public void setData(DataHandler value) {
                this.data = value;
            }

        }

    }


    /**
     * <p>Java class for anonymous complex type.
     * 
     * <p>The following schema fragment specifies the expected content contained within this class.
     * 
     * <pre>
     * &lt;complexType>
     *   &lt;complexContent>
     *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *       &lt;sequence>
     *         &lt;element name="contact" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="referenceType" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;choice>
     *                     &lt;element name="referenceCode" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                     &lt;element name="externalId" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;/choice>
     *                   &lt;element name="info1" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="info2" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="info3" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                 &lt;/sequence>
     *               &lt;/restriction>
     *             &lt;/complexContent>
     *           &lt;/complexType>
     *         &lt;/element>
     *       &lt;/sequence>
     *     &lt;/restriction>
     *   &lt;/complexContent>
     * &lt;/complexType>
     * </pre>
     * 
     * 
     */
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "", propOrder = {
        "contact"
    })
    public static class Contacts {

        @XmlElement(nillable = true)
        protected List<InstanceMessageCreateRequest.Contacts.Contact> contact;

        /**
         * Gets the value of the contact property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the contact property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getContact().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageCreateRequest.Contacts.Contact }
         * 
         * 
         */
        public List<InstanceMessageCreateRequest.Contacts.Contact> getContact() {
            if (contact == null) {
                contact = new ArrayList<InstanceMessageCreateRequest.Contacts.Contact>();
            }
            return this.contact;
        }


        /**
         * <p>Java class for anonymous complex type.
         * 
         * <p>The following schema fragment specifies the expected content contained within this class.
         * 
         * <pre>
         * &lt;complexType>
         *   &lt;complexContent>
         *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *       &lt;sequence>
         *         &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="referenceType" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;choice>
         *           &lt;element name="referenceCode" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *           &lt;element name="externalId" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;/choice>
         *         &lt;element name="info1" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="info2" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="info3" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *       &lt;/sequence>
         *     &lt;/restriction>
         *   &lt;/complexContent>
         * &lt;/complexType>
         * </pre>
         * 
         * 
         */
        @XmlAccessorType(XmlAccessType.FIELD)
        @XmlType(name = "", propOrder = {
            "type",
            "referenceType",
            "referenceCode",
            "externalId",
            "info1",
            "info2",
            "info3"
        })
        public static class Contact {

            @XmlElement(required = true)
            protected String type;
            @XmlElement(required = true)
            protected String referenceType;
            protected String referenceCode;
            protected String externalId;
            @XmlElementRef(name = "info1", type = JAXBElement.class, required = false)
            protected JAXBElement<String> info1;
            @XmlElementRef(name = "info2", type = JAXBElement.class, required = false)
            protected JAXBElement<String> info2;
            @XmlElementRef(name = "info3", type = JAXBElement.class, required = false)
            protected JAXBElement<String> info3;

            /**
             * Gets the value of the type property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getType() {
                return type;
            }

            /**
             * Sets the value of the type property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setType(String value) {
                this.type = value;
            }

            /**
             * Gets the value of the referenceType property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getReferenceType() {
                return referenceType;
            }

            /**
             * Sets the value of the referenceType property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setReferenceType(String value) {
                this.referenceType = value;
            }

            /**
             * Gets the value of the referenceCode property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getReferenceCode() {
                return referenceCode;
            }

            /**
             * Sets the value of the referenceCode property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setReferenceCode(String value) {
                this.referenceCode = value;
            }

            /**
             * Gets the value of the externalId property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getExternalId() {
                return externalId;
            }

            /**
             * Sets the value of the externalId property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setExternalId(String value) {
                this.externalId = value;
            }

            /**
             * Gets the value of the info1 property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getInfo1() {
                return info1;
            }

            /**
             * Sets the value of the info1 property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setInfo1(JAXBElement<String> value) {
                this.info1 = value;
            }

            /**
             * Gets the value of the info2 property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getInfo2() {
                return info2;
            }

            /**
             * Sets the value of the info2 property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setInfo2(JAXBElement<String> value) {
                this.info2 = value;
            }

            /**
             * Gets the value of the info3 property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getInfo3() {
                return info3;
            }

            /**
             * Sets the value of the info3 property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setInfo3(JAXBElement<String> value) {
                this.info3 = value;
            }

        }

    }


    /**
     * <p>Java class for anonymous complex type.
     * 
     * <p>The following schema fragment specifies the expected content contained within this class.
     * 
     * <pre>
     * &lt;complexType>
     *   &lt;complexContent>
     *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *       &lt;sequence>
     *         &lt;element name="reference" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
     *                   &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                   &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
     *                 &lt;/sequence>
     *               &lt;/restriction>
     *             &lt;/complexContent>
     *           &lt;/complexType>
     *         &lt;/element>
     *       &lt;/sequence>
     *     &lt;/restriction>
     *   &lt;/complexContent>
     * &lt;/complexType>
     * </pre>
     * 
     * 
     */
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "", propOrder = {
        "reference"
    })
    public static class References {

        @XmlElement(nillable = true)
        protected List<InstanceMessageCreateRequest.References.Reference> reference;

        /**
         * Gets the value of the reference property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the reference property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getReference().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageCreateRequest.References.Reference }
         * 
         * 
         */
        public List<InstanceMessageCreateRequest.References.Reference> getReference() {
            if (reference == null) {
                reference = new ArrayList<InstanceMessageCreateRequest.References.Reference>();
            }
            return this.reference;
        }


        /**
         * <p>Java class for anonymous complex type.
         * 
         * <p>The following schema fragment specifies the expected content contained within this class.
         * 
         * <pre>
         * &lt;complexType>
         *   &lt;complexContent>
         *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *       &lt;sequence>
         *         &lt;element name="id" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
         *         &lt;element name="appIdentifier" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *         &lt;element name="appIdentifierDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
         *       &lt;/sequence>
         *     &lt;/restriction>
         *   &lt;/complexContent>
         * &lt;/complexType>
         * </pre>
         * 
         * 
         */
        @XmlAccessorType(XmlAccessType.FIELD)
        @XmlType(name = "", propOrder = {
            "id",
            "appIdentifier",
            "appIdentifierDate"
        })
        public static class Reference {

            @XmlElementRef(name = "id", type = JAXBElement.class, required = false)
            protected JAXBElement<BigInteger> id;
            @XmlElementRef(name = "appIdentifier", type = JAXBElement.class, required = false)
            protected JAXBElement<String> appIdentifier;
            @XmlElementRef(name = "appIdentifierDate", type = JAXBElement.class, required = false)
            protected JAXBElement<XMLGregorianCalendar> appIdentifierDate;

            /**
             * Gets the value of the id property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public JAXBElement<BigInteger> getId() {
                return id;
            }

            /**
             * Sets the value of the id property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public void setId(JAXBElement<BigInteger> value) {
                this.id = value;
            }

            /**
             * Gets the value of the appIdentifier property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getAppIdentifier() {
                return appIdentifier;
            }

            /**
             * Sets the value of the appIdentifier property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setAppIdentifier(JAXBElement<String> value) {
                this.appIdentifier = value;
            }

            /**
             * Gets the value of the appIdentifierDate property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public JAXBElement<XMLGregorianCalendar> getAppIdentifierDate() {
                return appIdentifierDate;
            }

            /**
             * Sets the value of the appIdentifierDate property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public void setAppIdentifierDate(JAXBElement<XMLGregorianCalendar> value) {
                this.appIdentifierDate = value;
            }

        }

    }


    /**
     * <p>Java class for anonymous complex type.
     * 
     * <p>The following schema fragment specifies the expected content contained within this class.
     * 
     * <pre>
     * &lt;complexType>
     *   &lt;complexContent>
     *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *       &lt;sequence>
     *         &lt;element name="topic" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="path" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                 &lt;/sequence>
     *               &lt;/restriction>
     *             &lt;/complexContent>
     *           &lt;/complexType>
     *         &lt;/element>
     *       &lt;/sequence>
     *     &lt;/restriction>
     *   &lt;/complexContent>
     * &lt;/complexType>
     * </pre>
     * 
     * 
     */
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "", propOrder = {
        "topic"
    })
    public static class Topics {

        @XmlElement(nillable = true)
        protected List<InstanceMessageCreateRequest.Topics.Topic> topic;

        /**
         * Gets the value of the topic property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the topic property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getTopic().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageCreateRequest.Topics.Topic }
         * 
         * 
         */
        public List<InstanceMessageCreateRequest.Topics.Topic> getTopic() {
            if (topic == null) {
                topic = new ArrayList<InstanceMessageCreateRequest.Topics.Topic>();
            }
            return this.topic;
        }


        /**
         * <p>Java class for anonymous complex type.
         * 
         * <p>The following schema fragment specifies the expected content contained within this class.
         * 
         * <pre>
         * &lt;complexType>
         *   &lt;complexContent>
         *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *       &lt;sequence>
         *         &lt;element name="path" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *       &lt;/sequence>
         *     &lt;/restriction>
         *   &lt;/complexContent>
         * &lt;/complexType>
         * </pre>
         * 
         * 
         */
        @XmlAccessorType(XmlAccessType.FIELD)
        @XmlType(name = "", propOrder = {
            "path"
        })
        public static class Topic {

            @XmlElement(required = true)
            protected String path;

            /**
             * Gets the value of the path property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getPath() {
                return path;
            }

            /**
             * Sets the value of the path property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setPath(String value) {
                this.path = value;
            }

        }

    }


    /**
     * <p>Java class for anonymous complex type.
     * 
     * <p>The following schema fragment specifies the expected content contained within this class.
     * 
     * <pre>
     * &lt;complexType>
     *   &lt;complexContent>
     *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *       &lt;sequence>
     *         &lt;element name="variable" maxOccurs="unbounded" minOccurs="0">
     *           &lt;complexType>
     *             &lt;complexContent>
     *               &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
     *                 &lt;sequence>
     *                   &lt;element name="key" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
     *                   &lt;choice>
     *                     &lt;element name="valueString" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
     *                     &lt;element name="valueInteger" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
     *                     &lt;element name="valueDecimal" type="{http://www.w3.org/2001/XMLSchema}decimal" minOccurs="0"/>
     *                     &lt;element name="valueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
     *                     &lt;element name="valueBoolean" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
     *                   &lt;/choice>
     *                 &lt;/sequence>
     *               &lt;/restriction>
     *             &lt;/complexContent>
     *           &lt;/complexType>
     *         &lt;/element>
     *       &lt;/sequence>
     *     &lt;/restriction>
     *   &lt;/complexContent>
     * &lt;/complexType>
     * </pre>
     * 
     * 
     */
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "", propOrder = {
        "variable"
    })
    public static class Variables {

        @XmlElement(nillable = true)
        protected List<InstanceMessageCreateRequest.Variables.Variable> variable;

        /**
         * Gets the value of the variable property.
         * 
         * <p>
         * This accessor method returns a reference to the live list,
         * not a snapshot. Therefore any modification you make to the
         * returned list will be present inside the JAXB object.
         * This is why there is not a <CODE>set</CODE> method for the variable property.
         * 
         * <p>
         * For example, to add a new item, do as follows:
         * <pre>
         *    getVariable().add(newItem);
         * </pre>
         * 
         * 
         * <p>
         * Objects of the following type(s) are allowed in the list
         * {@link InstanceMessageCreateRequest.Variables.Variable }
         * 
         * 
         */
        public List<InstanceMessageCreateRequest.Variables.Variable> getVariable() {
            if (variable == null) {
                variable = new ArrayList<InstanceMessageCreateRequest.Variables.Variable>();
            }
            return this.variable;
        }


        /**
         * <p>Java class for anonymous complex type.
         * 
         * <p>The following schema fragment specifies the expected content contained within this class.
         * 
         * <pre>
         * &lt;complexType>
         *   &lt;complexContent>
         *     &lt;restriction base="{http://www.w3.org/2001/XMLSchema}anyType">
         *       &lt;sequence>
         *         &lt;element name="key" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;element name="type" type="{http://www.w3.org/2001/XMLSchema}string"/>
         *         &lt;choice>
         *           &lt;element name="valueString" type="{http://www.w3.org/2001/XMLSchema}string" minOccurs="0"/>
         *           &lt;element name="valueInteger" type="{http://www.w3.org/2001/XMLSchema}integer" minOccurs="0"/>
         *           &lt;element name="valueDecimal" type="{http://www.w3.org/2001/XMLSchema}decimal" minOccurs="0"/>
         *           &lt;element name="valueDate" type="{http://www.w3.org/2001/XMLSchema}dateTime" minOccurs="0"/>
         *           &lt;element name="valueBoolean" type="{http://www.w3.org/2001/XMLSchema}boolean" minOccurs="0"/>
         *         &lt;/choice>
         *       &lt;/sequence>
         *     &lt;/restriction>
         *   &lt;/complexContent>
         * &lt;/complexType>
         * </pre>
         * 
         * 
         */
        @XmlAccessorType(XmlAccessType.FIELD)
        @XmlType(name = "", propOrder = {
            "key",
            "type",
            "valueString",
            "valueInteger",
            "valueDecimal",
            "valueDate",
            "valueBoolean"
        })
        public static class Variable {

            @XmlElement(required = true)
            protected String key;
            @XmlElement(required = true)
            protected String type;
            @XmlElementRef(name = "valueString", type = JAXBElement.class, required = false)
            protected JAXBElement<String> valueString;
            @XmlElementRef(name = "valueInteger", type = JAXBElement.class, required = false)
            protected JAXBElement<BigInteger> valueInteger;
            @XmlElementRef(name = "valueDecimal", type = JAXBElement.class, required = false)
            protected JAXBElement<BigDecimal> valueDecimal;
            @XmlElementRef(name = "valueDate", type = JAXBElement.class, required = false)
            protected JAXBElement<XMLGregorianCalendar> valueDate;
            @XmlElementRef(name = "valueBoolean", type = JAXBElement.class, required = false)
            protected JAXBElement<Boolean> valueBoolean;

            /**
             * Gets the value of the key property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getKey() {
                return key;
            }

            /**
             * Sets the value of the key property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setKey(String value) {
                this.key = value;
            }

            /**
             * Gets the value of the type property.
             * 
             * @return
             *     possible object is
             *     {@link String }
             *     
             */
            public String getType() {
                return type;
            }

            /**
             * Sets the value of the type property.
             * 
             * @param value
             *     allowed object is
             *     {@link String }
             *     
             */
            public void setType(String value) {
                this.type = value;
            }

            /**
             * Gets the value of the valueString property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public JAXBElement<String> getValueString() {
                return valueString;
            }

            /**
             * Sets the value of the valueString property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link String }{@code >}
             *     
             */
            public void setValueString(JAXBElement<String> value) {
                this.valueString = value;
            }

            /**
             * Gets the value of the valueInteger property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public JAXBElement<BigInteger> getValueInteger() {
                return valueInteger;
            }

            /**
             * Sets the value of the valueInteger property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link BigInteger }{@code >}
             *     
             */
            public void setValueInteger(JAXBElement<BigInteger> value) {
                this.valueInteger = value;
            }

            /**
             * Gets the value of the valueDecimal property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}
             *     
             */
            public JAXBElement<BigDecimal> getValueDecimal() {
                return valueDecimal;
            }

            /**
             * Sets the value of the valueDecimal property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link BigDecimal }{@code >}
             *     
             */
            public void setValueDecimal(JAXBElement<BigDecimal> value) {
                this.valueDecimal = value;
            }

            /**
             * Gets the value of the valueDate property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public JAXBElement<XMLGregorianCalendar> getValueDate() {
                return valueDate;
            }

            /**
             * Sets the value of the valueDate property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link XMLGregorianCalendar }{@code >}
             *     
             */
            public void setValueDate(JAXBElement<XMLGregorianCalendar> value) {
                this.valueDate = value;
            }

            /**
             * Gets the value of the valueBoolean property.
             * 
             * @return
             *     possible object is
             *     {@link JAXBElement }{@code <}{@link Boolean }{@code >}
             *     
             */
            public JAXBElement<Boolean> getValueBoolean() {
                return valueBoolean;
            }

            /**
             * Sets the value of the valueBoolean property.
             * 
             * @param value
             *     allowed object is
             *     {@link JAXBElement }{@code <}{@link Boolean }{@code >}
             *     
             */
            public void setValueBoolean(JAXBElement<Boolean> value) {
                this.valueBoolean = value;
            }

        }

    }

}
